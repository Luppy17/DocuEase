<?php

namespace App\Http\Controllers;

use App\Models\department;
use App\Models\Document;
use App\Models\FileSharing;
use App\Models\User;
use Illuminate\Http\Request;

class FileAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendingApprovalDocument = Document::where('dept_id',auth()->user()->dept_id)
        ->whereNull('file_admin_approval_id')
        ->where('status','Pending')
        ->count();

        $pendingApprovalViewDocument = FileSharing::
        whereNull('file_admin_approval_id')
        ->where('status','Pending')
        ->whereHas('document', function($query) {
            $query->where('dept_id', auth()->user()->dept_id);
        })
        ->count();

        return view('FileAdmin.dashboard',compact('pendingApprovalDocument','pendingApprovalViewDocument'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function docupdaproval()
    {
        $pendingApprovalDocument = Document::where('dept_id',auth()->user()->dept_id)
        ->whereNull('file_admin_approval_id')
        ->where('status','Pending')
        ->latest()->get();

        return view('FileAdmin.docapprove',compact('pendingApprovalDocument'));
    }

    public function docviewapproval()
    {
        $pendingApprovalViewDocument = FileSharing::
        whereNull('file_admin_approval_id')
        ->where('status','Pending')
        ->whereHas('document', function($query) {
            $query->where('dept_id', auth()->user()->dept_id);
        })
        ->latest()->get();

        return view('FileAdmin.docviewapprove',compact('pendingApprovalViewDocument'));
    }

    public function viewDepartmentDocuments()
    {
        $documents = Document::where('dept_id', auth()->user()->dept_id)
            ->with(['creator', 'folder', 'department'])
            ->latest()
            ->get();

        return view('FileAdmin.department-documents', compact('documents'));
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
