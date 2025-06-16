<?php

namespace App\Http\Controllers;

use App\Mail\DocumentUploaded;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\document_logs;
use App\Models\DocumentFolder;
use App\Models\FileSharing;
use App\Models\StarredDocument;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class FileController extends Controller
{
public function createFolder(Request $request)
{
    $folder = DocumentFolder::create([
        'folder_name' => $request->folder_name,
        'created_by' => auth()->id(),
    ]);

    $logs = new document_logs;
    $logs->action = "CREATE FOLDER";
    $logs->owner_id = auth()->user()->id;
    $logs->created_by = auth()->user()->id;
    $logs->reference = $request->folder_name;
    $logs->save();

    return response()->json(['message' => 'Folder created successfully.', 'folder' => $folder]);
}

public function renameFolder(Request $request, $id)
{
    $folder = DocumentFolder::findOrFail($id);

    $logs = new document_logs;
    $logs->action = "RENAME FOLDER";
    $logs->owner_id = $folder->created_by;
    $logs->created_by = auth()->user()->id;
    $logs->reference = $folder->folder_name.' to '.$request->folder_name;
    $logs->save();

    $folder->update(['folder_name' => $request->folder_name, 'updated_by' => auth()->id()]);

    return response()->json(['message' => 'Folder renamed successfully.']);
}

public function deleteFolder($id)
{
    $folder = DocumentFolder::findOrFail($id);

    $logs = new document_logs;
    $logs->action = "DELETE FOLDER";
    $logs->owner_id = $folder->created_by;
    $logs->created_by = auth()->user()->id;
    $logs->reference = $folder->folder_name;
    $logs->save();

    DocumentFolder::findOrFail($id)->delete();

    Document::where('document_folder',$id)->delete();

    return response()->json(['message' => 'Folder deleted successfully.']);
}

public function upload(Request $request)
{
    $request->validate(['document_file' => 'required|file']);

    $path = $request->file('document_file')->store('documents');

    $document = Document::create([
        'document_title' => $request->document_title,
        'document_file' => $path ?? null,
        'document_folder' => $request->document_folder,
        'dept_id' => auth()->user()->dept_id,
        'created_by' => auth()->id(),
    ]);

    $logs = new document_logs;
    $logs->action = "UPLOAD FILE";
    $logs->owner_id = auth()->user()->id;
    $logs->created_by = auth()->user()->id;
    $logs->reference = $request->document_title;
    $logs->save();


        $emails = DB::table('users')
        ->where('dept_id', $document->dept_id)
        ->whereIn('role', ['Manager','File Admin'])
        ->pluck('email')
        ->toArray();

      Mail::to($emails)
          ->send(new DocumentUploaded($document));

    return response()->json(['message' => 'File uploaded successfully, awaiting approval.', 'document' => $document]);
}

public function viewFile($id)
{
    $document = Document::findOrFail($id);

    if ($document->status != 'Approved') {
        return redirect('/forbidden');
    }

    $logs = new document_logs;
    $logs->action = "VIEW FILE";
    $logs->owner_id = $document->created_by;
    $logs->created_by = auth()->user()->id;
    $logs->reference = $document->document_title;
    $logs->save();

    return response()->file(storage_path('app/' . $document->document_file));
}

public function viewFileAdmin($id)
{
    $document = Document::findOrFail($id);

    $logs = new document_logs;
    $logs->action = "VIEW FILE";
    $logs->owner_id = $document->created_by;
    $logs->created_by = auth()->user()->id;
    $logs->reference = $document->document_title;
    $logs->save();

    return response()->file(storage_path('app/' . $document->document_file));
}

public function deleteFile($id)
{
    $doc = Document::findOrFail($id);

    $logs = new document_logs;
    $logs->action = "DELETE FILE";
    $logs->owner_id = $doc->created_by;
    $logs->created_by = auth()->user()->id;
    $logs->reference = $doc->document_title;
    $logs->save();

    $doc->delete();

    return response()->json(['message' => 'File deleted successfully.']);
}

public function openFolder($id)
{
    $currentFolder = DocumentFolder::findOrFail($id);

    $documents = Document::where('document_folder', $id)->get();

    return view('Staff.documentsfolder', compact('documents', 'currentFolder', 'id'));
}


public function editFile(Request $request, $id) {
    $document = Document::findOrFail($id);

    if ($request->filled('document_title')) {

        $logs = new document_logs;
        $logs->action = "UPDATE FILE TITLE";
        $logs->owner_id = $document->created_by;
        $logs->created_by = auth()->user()->id;
        $logs->reference = $document->document_title.' to '.$request->document_title;
        $logs->save();

        $document->document_title = $request->document_title;
    }

    if ($request->hasFile('document_file')) {

        $logs = new document_logs;
        $logs->action = "FILE REPLACED";
        $logs->owner_id = $document->created_by;
        $logs->created_by = auth()->user()->id;
        $logs->reference = $document->document_title;
        $logs->filepath = $document->document_file;
        $logs->save();

        $file = $request->file('document_file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $filename);
        $document->document_file = 'uploads/' . $filename; // Adjust to your DB column
    }

    $document->updated_by = auth()->id();
    $document->save();

    return response()->json(['message' => 'File updated successfully']);
}

public function getFile($id) {
    $document = Document::findOrFail($id);
    return response()->json([
        'document_title' => $document->document_title,
    ]);
}

    public function starDocument(Document $document)
    {
        try {
            // Ensure the user is authenticated
            $user = auth()->user();
            if (!$user) {
                return response()->json(['status' => 'error', 'message' => 'Authentication required.'], 401);
            }

            // Create a new starred document entry
            StarredDocument::create([
                'user_id' => $user->id,
                'document_id' => $document->document_id,
            ]);

            return response()->json(['status' => 'success', 'message' => 'File starred successfully!']);
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle unique constraint violation (if user tries to star an already starred document)
            if ($e->getCode() == 23000) { // MySQL integrity constraint violation
                return response()->json(['status' => 'error', 'message' => 'File is already starred.'], 409);
            }
            return response()->json(['status' => 'error', 'message' => $e], 500);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'An unexpected error occurred.'], 500);
        }
    }

    public function unstarDocument(Document $document)
    {
        try {
            $user = auth()->user();
            if (!$user) {
                return response()->json(['status' => 'error', 'message' => 'Authentication required.'], 401);
            }

            // Delete the starred document entry
            StarredDocument::where('user_id', $user->id)
                           ->where('document_id', $document->document_id)
                           ->delete();

            return response()->json(['status' => 'success', 'message' => 'File unstarred successfully!']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Could not unstar file.'], 500);
        }
    }

    public function showStarredFiles()
    {
        $user = auth()->user();

        // Get starred document IDs for the current user
        $starredDocumentIds = StarredDocument::where('user_id', $user->id)
                                          ->pluck('document_id');

        // Fetch the actual document details for these IDs
        $documents = Document::whereIn('document_id', $starredDocumentIds)
                         ->with(['creator.department']) // Eager load relationships
                         ->orderBy('updated_at', 'desc')
                         ->get();

        // You might also want to pass an empty collection for folders, or remove the folder loop
        $folders = collect(); // No folders on a starred files page

        // Pass necessary variables to the view
        // Assuming 'dashboard' is your page variable for sidebar active state
        $page = 'starred-files'; // Set the page variable for the sidebar
        $currentFolder = null; // No specific current folder for this page

        return view('staff.starred-files', compact('documents', 'folders', 'page', 'currentFolder'));
    }

    /**
     * Restore a soft-deleted file
     */
    public function restoreFile($id)
    {
        $document = Document::withTrashed()->findOrFail($id);

        // Check if user has permission to restore this file
        if ($document->created_by !== auth()->id()) {
            return response()->json(['message' => 'You do not have permission to restore this file.'], 403);
        }

        $document->restore();

        $logs = new document_logs;
        $logs->action = "RESTORE FILE";
        $logs->owner_id = $document->created_by;
        $logs->created_by = auth()->user()->id;
        $logs->reference = $document->document_title;
        $logs->save();

        return response()->json(['message' => 'File restored successfully.']);
    }

    /**
     * Restore all soft-deleted files for the current user
     */
    public function restoreAllFiles()
    {
        $documents = Document::withTrashed()
            ->where('created_by', auth()->id())
            ->whereNotNull('deleted_at')
            ->get();

        foreach ($documents as $document) {
            $document->restore();

            $logs = new document_logs;
            $logs->action = "RESTORE FILE";
            $logs->owner_id = $document->created_by;
            $logs->created_by = auth()->user()->id;
            $logs->reference = $document->document_title;
            $logs->save();
        }

        return response()->json(['message' => 'All files restored successfully.']);
    }

    /**
     * Permanently delete a file
     */
    public function permanentlyDeleteFile($id)
    {
        $document = Document::withTrashed()->findOrFail($id);

        // Check if user has permission to delete this file
        if ($document->created_by !== auth()->id()) {
            return response()->json(['message' => 'You do not have permission to delete this file.'], 403);
        }

        // Delete the physical file from storage
        if ($document->document_file) {
            Storage::delete($document->document_file);
        }

        // Log the permanent deletion
        $logs = new document_logs;
        $logs->action = "PERMANENTLY DELETE FILE";
        $logs->owner_id = $document->created_by;
        $logs->created_by = auth()->user()->id;
        $logs->reference = $document->document_title;
        $logs->save();

        // Force delete the record
        $document->forceDelete();

        return response()->json(['message' => 'File permanently deleted.']);
    }

    /**
     * Empty the trash bin for the current user
     */
    public function emptyBin()
    {
        $documents = Document::withTrashed()
            ->where('created_by', auth()->id())
            ->whereNotNull('deleted_at')
            ->get();

        foreach ($documents as $document) {
            // Delete the physical file from storage
            if ($document->document_file) {
                Storage::delete($document->document_file);
            }

            // Log the permanent deletion
            $logs = new document_logs;
            $logs->action = "PERMANENTLY DELETE FILE";
            $logs->owner_id = $document->created_by;
            $logs->created_by = auth()->user()->id;
            $logs->reference = $document->document_title;
            $logs->save();

            // Force delete the record
            $document->forceDelete();
        }

        return response()->json(['message' => 'Trash bin emptied successfully.']);
    }
}
