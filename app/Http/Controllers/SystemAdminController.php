<?php

namespace App\Http\Controllers;

use App\Models\department;
use App\Models\document_logs;
use App\Models\system_logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SystemAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // your existing totals
        $staff     = User::where('role','Staff')->count();
        $fileadmin = User::where('role','File Admin')->count();
        $manager   = User::where('role','Manager')->count();
        $dept      = Department::count();

        // new: overall login/logout counts
        $loginCount  = system_logs::where('log','LOGGED IN')->count();
        $logoutCount = system_logs::where('log','LOGGED OUT')->count();

        // new: recent uploads (DocumentLog entries)
        $recentUploads = document_logs::where('action','UPLOAD FILE')
            ->orderBy('created_at','desc')
            ->take(5)
            ->get();

        // new: past 7-day login/logout series
        $startDate = Carbon::now()->subDays(6)->startOfDay();
        $series = system_logs::select(
                DB::raw("DATE(created_at) as date"),
                DB::raw("SUM(CASE WHEN log='LOGGED IN'  THEN 1 ELSE 0 END) as logins"),
                DB::raw("SUM(CASE WHEN log='LOGGED OUT' THEN 1 ELSE 0 END) as logouts")
            )
            ->where('created_at','>=',$startDate)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $chartLabels  = $series->pluck('date')->map(fn($d)=> Carbon::parse($d)->format('Y-m-d'));
        $chartLogins  = $series->pluck('logins');
        $chartLogouts = $series->pluck('logouts');

                // NEW: uploads grouped by uploader's department
                $uploadsByDept = document_logs::join('users','document_logs.created_by','users.id')
                ->join('department','users.dept_id','department.dept_id')
                ->where('action','UPLOAD FILE')
                ->select('department.dept_name', DB::raw('COUNT(*) as total'))
                ->groupBy('department.dept_name')
                ->orderBy('total','desc')
                ->get();
    
            $uploadDeptLabels = $uploadsByDept->pluck('dept_name');
            $uploadDeptData   = $uploadsByDept->pluck('total');

        return view('SystemAdmin.dashboard', compact(
            'staff','fileadmin','manager','dept',
            'loginCount','logoutCount',
            'recentUploads',
            'chartLabels','chartLogins','chartLogouts','uploadDeptLabels','uploadDeptData'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function users()
    {
        $users = User::whereIn('role',['Staff','File Admin','Manager'])->get();
        $departments = department::all();

        return view('SystemAdmin.users',compact('users','departments'));
    }

    public function department()
    {
        $departments = department::all();

        return view('SystemAdmin.department',compact('departments'));
    }

    public function showUser($id)
{
    $user = User::findOrFail($id);
    return response()->json($user);
}

    /**
     * Store a newly created resource in storage.
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:Staff,File Admin,Manager',
            'dept_id' => 'required|exists:department,dept_id',
        ]);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'dept_id' => $request->dept_id,
        ]);
    
        return response()->json(['message' => 'User created successfully.']);
    }

    // Update user
public function updateUser(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,'.$id,
        'role' => 'required|in:Staff,File Admin,Manager',
        'dept_id' => 'required|exists:department,dept_id',
    ]);

    $user = User::findOrFail($id);
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'dept_id' => $request->dept_id,
    ]);

    // Update password if provided
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
        $user->save();
    }

    return response()->json(['message' => 'User updated successfully.']);
}

// Delete user
public function destroyUser($id)
{
    User::findOrFail($id)->delete();
    return response()->json(['message' => 'User deleted successfully.']);
}


// Show
public function showDept($id){
    return response()->json(department::findOrFail($id));
}

// Store
public function storeDept(Request $request){
    $request->validate(['dept_name' => 'required|unique:department,dept_name']);
    department::create(['dept_name' => $request->dept_name]);
    return response()->json(['message' => 'Department created successfully.']);
}

// Update
public function updateDept(Request $request, $id){
    $request->validate(['dept_name' => 'required|unique:department,dept_name,'.$id.',dept_id']);
    department::findOrFail($id)->update(['dept_name' => $request->dept_name]);
    return response()->json(['message' => 'Department updated successfully.']);
}

// Delete
public function destroyDept($id){
    department::findOrFail($id)->delete();
    return response()->json(['message' => 'Department deleted successfully.']);
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
