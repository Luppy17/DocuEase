<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\document_logs;
use App\Models\DocumentFolder;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Document::
        whereNull('document_folder')
        ->latest()
        ->get();

        $folders = DocumentFolder::latest()->get();

        return view('Staff.documents',compact('documents','folders'));
    }

        public function indexapproved()
    {
        $documents = Document::
         where('created_by', auth()->id())
        ->where('status', 'Approved')
        ->latest()
        ->get();

        return view('Staff.documents-approved',compact('documents'));
    }

        public function indexdeleted()
    {
        $documents = Document::withTrashed()
         ->where('created_by', auth()->id())
        ->whereNotNull('deleted_at')
        ->latest()
        ->get();

        return view('Staff.documents-deleted',compact('documents'));
    }

        public function indexrejected()
    {
         $documents = Document::
         where('created_by', auth()->id())
        ->where('status', 'Rejected')
        ->latest()
        ->get();

        return view('Staff.documents-rejected',compact('documents'));
    }

        public function indexme()
    {
        $documents = Document::
        whereNull('document_folder')
        ->where('created_by', auth()->id())
        ->latest()
        ->get();

        $folders = DocumentFolder::latest()->where('created_by', auth()->id())->get();

        return view('Staff.documents-me',compact('documents','folders'));
    }

        public function indexrecent()
    {
        $documents = Document::
            whereNull('document_folder')
            ->latest()
            ->take(10)
            ->get();

        $folders = DocumentFolder::latest()
            ->take(10)
            ->get();

        return view('Staff.documents-recent', compact('documents', 'folders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function viewfilestaff($id)
    {
        $path =  DB::table('document_logs')->where('logs_id',$id)->first()->filepath;

        return response()->file(storage_path('app/' . $path));
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
