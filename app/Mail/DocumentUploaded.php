<?php

namespace App\Mail;

use App\Models\Document;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DocumentUploaded extends Mailable
{
    use Queueable, SerializesModels;

    public Document $document;

    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    public function build()
    {
        return $this
            ->subject("New Document Pending Approval: {$this->document->document_title}")
            ->view('emails.document_uploaded')
            ->with([
                'title'      => $this->document->document_title,
                'uploadedBy' => $this->document->creator->name,
                'uploadedAt' => $this->document->created_at->format('M d, Y H:i')
            ]);
    }
}
