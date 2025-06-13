<?php

namespace App\Mail;

use App\Models\FileSharing;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FileRequested extends Mailable
{
    use Queueable, SerializesModels;

    public FileSharing $sharing;
    public string      $requesterName;

    public function __construct(FileSharing $sharing)
    {
        $this->sharing       = $sharing;
        $this->requesterName = $sharing->requester->name;
    }

    public function build()
    {
        return $this
            ->subject("New File View Request: {$this->sharing->document->document_title}")
            ->view('emails.file_requested')
            ->with([
                'title'        => $this->sharing->document->document_title,
                'requestedBy'  => $this->requesterName,
                'requestedAt'  => $this->sharing->created_at->format('M d, Y H:i')
            ]);
    }
}
