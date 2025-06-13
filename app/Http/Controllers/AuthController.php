<?php

namespace App\Http\Controllers;

use App\Mail\PendingActionReminder;
use App\Models\Document;
use App\Models\FileSharing;
use App\Models\system_logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'role' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        $user = User::where('email', $request->email)
                    ->where('role', $request->role)
                    ->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Invalid role or email.');
        }

        if (Auth::attempt($credentials)) {

            system_logs::create([
                'log' => 'LOGGED IN',
                'user_id' => $user->id,
            ]);

            $this->sendPendingActionRemindersTo($user);

            switch ($user->role) {
                case 'System Admin':
                    return redirect()->route('dashboard-admin')->with('success', 'Login successful!');
                case 'Staff':
                    return redirect()->route('dashboard-staff')->with('success', 'Login successful!');
                case 'File Admin':
                    return redirect()->route('dashboard-fileadmin')->with('success', 'Login successful!');
                case 'Manager':
                    return redirect()->route('dashboard-manager')->with('success', 'Login successful!');
                default:
                    return redirect()->route('/')->with('error', 'Unauthorized role.');
            }
        }

        return redirect()->back()->with('error', 'Invalid credentials.');
    }


    protected function sendPendingActionRemindersTo(User $user)
{
    $cutoff = Carbon::now()->subDay();
    $email  = $user->email;

    $sendBatch = function($records, $entityType, $actionType, $urlPrefix, $reminderColumn) use($email) {
        if ($records->isEmpty()) {
            return;
        }

        $titles = $records->pluck(
            $entityType === 'document'
                ? 'document_title'
                : 'document.document_title'
        )->toArray();

        try {
            Mail::to($email)
                ->send(new PendingActionReminder(
                    $entityType,
                    implode(', ', $titles),
                    $actionType
                ));
        } catch (\Exception $e) {
            Log::error("Reminder email failed for {$actionType} on {$entityType}: ".$e->getMessage());
        }

        $ids = $records->pluck($records->first()->getKeyName())->toArray();
        DB::table($records->first()->getTable())
            ->whereIn($records->first()->getKeyName(), $ids)
            ->update([$reminderColumn => now()]);
    };

    $docsMgr = Document::where('dept_id', $user->dept_id)
        ->whereNull('manager_approval_id')
        ->where('created_at','<=',$cutoff)
        ->whereNull('manager_reminder_sent_at')
        ->get();
    $sendBatch($docsMgr, 'document', 'Manager', 'manager/documents', 'manager_reminder_sent_at');

    $docsFA = Document::where('dept_id', $user->dept_id)
        ->whereNotNull('manager_approval_id')
        ->whereNull('file_admin_approval_id')
        ->where('created_at','<=',$cutoff)
        ->whereNull('file_admin_reminder_sent_at')
        ->get();
    $sendBatch($docsFA, 'document', 'File Admin', 'files/approve', 'file_admin_reminder_sent_at');

    $fsMgr = FileSharing::whereHas('document', fn($q)=> $q->where('dept_id',$user->dept_id))
        ->whereNull('manager_approval_id')
        ->where('created_at','<=',$cutoff)
        ->whereNull('manager_reminder_sent_at')
        ->get();
    $sendBatch($fsMgr, 'file-sharing', 'Manager', 'fileshare/approve', 'manager_reminder_sent_at');

    $fsFA = FileSharing::whereHas('document', fn($q)=> $q->where('dept_id',$user->dept_id))
        ->whereNotNull('manager_approval_id')
        ->whereNull('file_admin_approval_id')
        ->where('created_at','<=',$cutoff)
        ->whereNull('file_admin_reminder_sent_at')
        ->get();
    $sendBatch($fsFA, 'file-sharing', 'File Admin', 'fileshare/approve', 'file_admin_reminder_sent_at');
}


    public function logout(Request $request)
    {
        system_logs::create([
            'log' => 'LOGGED OUT',
            'user_id' => auth()->user()->id,
        ]);

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout Success!');
    }
}
