<?php

namespace App\Mail\Files;

use App\File;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FileApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $file;

    public $user;

    public function __construct(File $file)
    {
        $this->file = $file;
        $this->user = $file->user;
    }

    public function build()
    {
        return $this->subject('Your file "' .$this->file->title . '" has been approved')
            ->view('emails.files.new.approved');
    }
}
