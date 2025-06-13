<?php


namespace App\Http\Controllers;

use App\Mail\FileRequestApproved;
use App\Mail\FileRequested;
use App\Mail\FileRequestRejected;
use App\Models\FileSharing;
use Carbon\Carbon;
use App\Models\Document;
use App\Models\document_logs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class FileSharingController extends Controller
{
    public function requestView(Request $request)     
    {         
        $document = Document::findOrFail($request->document_id);

        $sharing = FileSharing::create([             
            'document_id' => $request->document_id,             
            'status' => 'Pending',             
            'filesharing_expiry_date' => Carbon::now()->addDays(30),
            'created_by' => auth()->id(),             
            'requested_by' => auth()->id(),         
        ]); 
        
        $logs = new document_logs;
        $logs->action = "FILE REQUESTED";
        $logs->owner_id = $document->created_by;
        $logs->created_by = auth()->user()->id;
        $logs->reference = $document->document_title;
        $logs->save();


        $emails = User::where('dept_id', $document->dept_id)
        ->whereIn('role',['Manager','File Admin'])
        ->pluck('email');

    try {
        Mail::to($emails)->send(new FileRequested($sharing));
    } catch (\Exception $e) {
        Log::error('FileRequested email failed: '.$e->getMessage());
    }
    
        return response()->json([
            'message' => 'Request submitted successfully.',
            'sharing' => $sharing
        ]);     
    }

    public function approveRequest(Request $request, $id)
    {
        $sharing = FileSharing::findOrFail($id);
        $user = auth()->user();

        if ($user->dept_id !== $sharing->document->dept_id) {
            return response()->json(['message' => 'Different department, cannot approve.'], 403);
        }

        if ($user->role == 'Manager') {
            $sharing->manager_approval_id = $user->id;
            $sharing->manager_approval_datetime = now();
        } elseif ($user->role == 'File Admin') {
            if (!$sharing->manager_approval_id) {
                return response()->json(['message' => 'Manager approval required first.'], 403);
            }
            $sharing->file_admin_approval_id = $user->id;
            $sharing->file_admin_approval_datetime = now();
            $sharing->status = 'Approved';
            $sharing->filesharing_expiry_date = Carbon::now()->addDays(7);
        }

        $sharing->save();

        if ($user->role==='File Admin' && $sharing->status === 'Approved') {
            try {
                Mail::to($sharing->requester->email)
                    ->send(new FileRequestApproved($sharing, $user->name));
            } catch (\Exception $e) {
                Log::error('FileRequestApproved email failed: '.$e->getMessage());
            }
        }

        return response()->json(['message' => 'File sharing approved successfully.']);
    }

    public function rejectRequest(Request $request, $id)
    {
        $user = auth()->user();
        $sharing = FileSharing::findOrFail($id);

        if ($user->dept_id !== $sharing->document->dept_id) {
            return response()->json(['message' => 'Different department, cannot reject.'], 403);
        }

        if ($user->role == 'Manager') {
            $sharing->manager_approval_id = $user->id;
            $sharing->manager_approval_datetime = now();
            $sharing->status = 'Rejected';
        } elseif ($user->role == 'File Admin') {
            $sharing->file_admin_approval_id = $user->id;
            $sharing->file_admin_approval_datetime = now();
            $sharing->status = 'Rejected';
        }
        $sharing->save();

        if ($sharing->status === 'Rejected') {
            try {
                Mail::to($sharing->requester->email)
                    ->send(new FileRequestRejected($sharing, $user->name));
            } catch (\Exception $e) {
                Log::error('FileRequestRejected email failed: '.$e->getMessage());
            }
        }
    

        return response()->json(['message' => 'Request rejected.']);
    }
}
