<?php

namespace App\Mail;

use App\Models\Document;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DocumentApproved extends Mailable
{
    use Queueable, SerializesModels;

    public Document $document;
    public string   $approverName;

    public function __construct(Document $document, string $approverName)
    {
        $this->document     = $document;
        $this->approverName = $approverName;
    }

    public function build()
    {
        return $this
            ->subject("Your document “{$this->document->document_title}” has been approved")
            ->view('emails.document_approved')
            ->with([
                'title'        => $this->document->document_title,
                'approvedBy'   => $this->approverName,
                'approvedAt'   => $this->document->file_admin_approval_datetime
                                  ?? $this->document->manager_approval_datetime
            ]);
    }
}
