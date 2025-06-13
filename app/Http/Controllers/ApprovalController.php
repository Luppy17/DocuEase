<?php

namespace App\Http\Controllers;

use App\Mail\DocumentApproved;
use App\Mail\DocumentRejected;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ApprovalController extends Controller
{
    public function approve(Request $request, $id)
    {
        $document = Document::findOrFail($id);
        $user = auth()->user();

        if ($user->dept_id !== $document->dept_id) {
            return response()->json(['message' => 'You must be in the same department to approve.'], 403);
        }

        if ($user->role == 'Manager') {
            $document->manager_approval_id = $user->id;
            $document->manager_approval_datetime = now();
        } elseif ($user->role == 'File Admin') {
            if (!$document->manager_approval_id) {
                return response()->json(['message' => 'Manager approval required first.'], 403);
            }
            $document->file_admin_approval_id = $user->id;
            $document->file_admin_approval_datetime = now();
            $document->status = 'Approved';
        }

        $document->save();


        if ($document->status === 'Approved') {
            try {
                Mail::to($document->creator->email)
                    ->send(new DocumentApproved($document, $user->name));
            } catch (\Exception $e) {
                Log::error("Approval email failed: ".$e->getMessage());
            }
        }

        return response()->json(['message' => 'Document approved successfully.']);
    }


    public function reject(Request $request, $id)
    {
        $document = Document::findOrFail($id);
        $user = auth()->user();

        if ($user->dept_id !== $document->dept_id) {
            return response()->json(['message' => 'You must be in the same department to approve.'], 403);
        }

        if ($user->role == 'Manager') {
            $document->manager_approval_id = $user->id;
            $document->manager_approval_datetime = now();
            $document->status = 'Rejected';
        } elseif ($user->role == 'File Admin') {
            $document->status = 'Rejected';
            $document->file_admin_approval_id = $user->id;
            $document->file_admin_approval_datetime = now();
        }

        $document->save();

        try {
            Mail::to($document->creator->email)
                ->send(new DocumentRejected($document, $user->name));
        } catch (\Exception $e) {
            Log::error("Rejection email failed: ".$e->getMessage());
        }

        return response()->json(['message' => 'Document rejected successfully.']);
    }

}