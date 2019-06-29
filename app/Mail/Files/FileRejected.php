<?php

namespace App\Mail\Files;

use App\File;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FileRejected extends Mailable
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
        return $this->subject('Your file "' .$this->file->title . '" has been rejected')
            ->view('emails.files.new.rejected');  
    }
}
