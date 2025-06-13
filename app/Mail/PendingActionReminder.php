<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PendingActionReminder extends Mailable
{
    use Queueable, SerializesModels;

    public string $entityType;    
    public string $title;        
    public string $actionType; 

    public function __construct(string $entityType, string $title, string $actionType)
    {
        $this->entityType = $entityType;
        $this->title      = $title;
        $this->actionType = $actionType;
    }

    public function build()
    {
        return $this
            ->subject("Reminder: {$this->actionType} action pending on “{$this->title}”")
            ->view('emails.pending_action_reminder')
            ->with([
                'entityType' => $this->entityType,
                'title'      => $this->title,
                'actionType' => $this->actionType,
            ]);
    }
}
