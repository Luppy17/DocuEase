<?php

namespace App\Mail;

use App\Models\FileSharing;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FileRequestRejected extends Mailable
{
    use Queueable, SerializesModels;

    public FileSharing $sharing;
    public string      $rejecterName;

    public function __construct(FileSharing $sharing, string $rejecterName)
    {
        $this->sharing      = $sharing;
        $this->rejecterName = $rejecterName;
    }

    public function build()
    {
        return $this
            ->subject("Your File Request Rejected: {$this->sharing->document->document_title}")
            ->view('emails.file_request_rejected')
            ->with([
                'title'       => $this->sharing->document->document_title,
                'rejectedBy'  => $this->rejecterName,
                'rejectedAt'  => $this->sharing->updated_at->format('M d, Y H:i')
            ]);
    }
}
