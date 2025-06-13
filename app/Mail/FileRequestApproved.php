<?php

namespace App\Mail;

use App\Models\FileSharing;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FileRequestApproved extends Mailable
{
    use Queueable, SerializesModels;

    public FileSharing $sharing;
    public string      $approverName;

    public function __construct(FileSharing $sharing, string $approverName)
    {
        $this->sharing      = $sharing;
        $this->approverName = $approverName;
    }

    public function build()
    {
        return $this
            ->subject("Your File Request Approved: {$this->sharing->document->document_title}")
            ->view('emails.file_request_approved')
            ->with([
                'title'       => $this->sharing->document->document_title,
                'approvedBy'  => $this->approverName,
                'approvedAt'  => $this->sharing->file_admin_approval_datetime->format('M d, Y H:i')
            ]);
    }
}
