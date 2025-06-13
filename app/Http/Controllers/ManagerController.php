<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\document_logs;
use App\Models\FileSharing;
use App\Models\system_logs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deptId = auth()->user()->dept_id;

        // 1) Your existing pending-approval counts
        $pendingApprovalDocument = Document::where('dept_id', $deptId)
            ->whereNull('manager_approval_id')
            ->where('status','Pending')
            ->count();

        $pendingApprovalViewDocument = FileSharing::whereNull('manager_approval_id')
            ->where('status','Pending')
            ->whereHas('document', fn($q) => $q->where('dept_id',$deptId))
            ->count();

        // 2) Login / Logout totals for your dept
        $loginCount = system_logs::join('users','system_logs.user_id','users.id')
            ->where('users.dept_id',$deptId)
            ->where('system_logs.log','LOGGED IN')
            ->count();

        $logoutCount = system_logs::join('users','system_logs.user_id','users.id')
            ->where('users.dept_id',$deptId)
            ->where('system_logs.log','LOGGED OUT')
            ->count();

        // 3) Recent uploads in your dept (last 5)
        $recentUploads = document_logs::select('document_logs.*')
        ->where('action', 'UPLOAD FILE')
        ->join('users', 'document_logs.created_by', '=', 'users.id')
        ->where('users.dept_id', $deptId)
        ->orderBy('document_logs.created_at', 'desc')
        ->take(5)
        ->get();

        // 4) 7-day login/logout trend for your dept
        $start = Carbon::now()->subDays(6)->startOfDay();

        $trend = system_logs::select(
                DB::raw("DATE(system_logs.created_at) as date"),
                DB::raw("SUM(CASE WHEN system_logs.log = 'LOGGED IN'  THEN 1 ELSE 0 END) as logins"),
                DB::raw("SUM(CASE WHEN system_logs.log = 'LOGGED OUT' THEN 1 ELSE 0 END) as logouts")
            )
            ->join('users', 'system_logs.user_id', '=', 'users.id')
            ->where('users.dept_id', $deptId)
            ->where('system_logs.created_at', '>=', $start)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $chartLabels   = $trend->pluck('date')->map(fn($d)=>Carbon::parse($d)->format('Y-m-d'));
        $chartLogins   = $trend->pluck('logins');
        $chartLogouts  = $trend->pluck('logouts');

        // 5) Uploads by user in your dept
        $uploadsByUser = document_logs::where('action','UPLOAD FILE')
        ->join('users', 'document_logs.created_by', '=', 'users.id')
        ->where('users.dept_id', $deptId)
        ->select('users.name', DB::raw('COUNT(*) as total'))
        ->groupBy('users.name')
        ->orderBy('total', 'desc')
        ->get();
    

        $uploadUserLabels = $uploadsByUser->pluck('name');
        $uploadUserData   = $uploadsByUser->pluck('total');

        return view('Manager.dashboard', compact(
            'pendingApprovalDocument',
            'pendingApprovalViewDocument',
            'loginCount',
            'logoutCount',
            'recentUploads',
            'chartLabels','chartLogins','chartLogouts',
            'uploadUserLabels','uploadUserData'
        ));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function docupdaproval()
    {
        $pendingApprovalDocument = Document::where('dept_id',auth()->user()->dept_id)
        ->whereNull('manager_approval_id')
        ->where('status','Pending')
        ->latest()->get();

        return view('Manager.docapprove',compact('pendingApprovalDocument'));
    }

    public function docviewapproval()
    {
        $pendingApprovalViewDocument = FileSharing::
        whereNull('manager_approval_id')
        ->where('status','Pending')
        ->whereHas('document', function($query) {
            $query->where('dept_id', auth()->user()->dept_id);
        })
        ->latest()->get();

        return view('Manager.docviewapprove',compact('pendingApprovalViewDocument'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
