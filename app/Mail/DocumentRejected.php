<?php

namespace App\Mail;

use App\Models\Document;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DocumentRejected extends Mailable
{
    use Queueable, SerializesModels;

    public Document $document;
    public string   $rejecterName;

    public function __construct(Document $document, string $rejecterName)
    {
        $this->document      = $document;
        $this->rejecterName  = $rejecterName;
    }

    public function build()
    {
        return $this
            ->subject("Your document “{$this->document->document_title}” has been rejected")
            ->view('emails.document_rejected')
            ->with([
                'title'        => $this->document->document_title,
                'rejectedBy'   => $this->rejecterName,
                'rejectedAt'   => now()
            ]);
    }
}
