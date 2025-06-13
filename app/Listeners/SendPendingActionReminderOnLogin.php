<?php

namespace App\Listeners;

use App\Mail\PendingActionReminder;
use App\Models\Document;
use App\Models\FileSharing;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Mail;

class SendPendingActionReminderOnLogin
{
    public function handle(Login $event)
    {
        $user   = $event->user;
        $cutoff = Carbon::now()->subDay();

        $sendAndMark = function($model, $column, $entityType, $actionType, $linkKey) use ($user, $cutoff) {
        $query = $model::query();
        
        // Handle different filtering logic for different models
        if ($model === Document::class) {
            $query->where('dept_id', $user->dept_id);
        } elseif ($model === FileSharing::class) {
            // Filter by document's department
            $query->whereHas('document', function($q) use ($user) {
                $q->where('dept_id', $user->dept_id);
            });
        }
        
        $pending = $query->when($actionType === 'File Admin', fn($q)=>
                $q->whereNotNull('manager_approval_id')
                ->whereNull('file_admin_approval_id')
            )
            ->when($actionType === 'Manager' && $entityType==='document', fn($q)=>
                $q->whereNull('manager_approval_id')
            )
            ->when($entityType==='file-sharing', fn($q)=>
                $q->whereNull('manager_approval_id')
                ->where('created_at','<=',$cutoff)
            )
            ->where('created_at','<=',$cutoff)
            ->whereNull($column)
            ->get();

            foreach ($pending as $item) {
                $title = $entityType==='document'
                    ? $item->document_title
                    : $item->document->document_title;

                Mail::to($user->email)
                    ->send(new PendingActionReminder(
                        $entityType,
                        $title,
                        $actionType
                    ));

                $item->{$column} = now();
                $item->save();
            }
        };

        if ($user->role === 'Manager') {
            $sendAndMark(Document::class, 'manager_reminder_sent_at', 'document', 'Manager', 'manager/documents');

            $sendAndMark(FileSharing::class, 'manager_reminder_sent_at', 'file-sharing', 'Manager', 'fileshare/approve');
        }

        if ($user->role === 'File Admin') {
            $sendAndMark(Document::class, 'file_admin_reminder_sent_at', 'document', 'File Admin', 'files/approve');

            $sendAndMark(FileSharing::class, 'file_admin_reminder_sent_at', 'file-sharing', 'File Admin', 'fileshare/approve');
        }
    }
}
