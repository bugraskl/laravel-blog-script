<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PostPublished extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $postUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($postUrl)
    {
        $this->postUrl = $postUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Post Published')
            ->view('emails.post-published')
            ->with(['postUrl' => $this->postUrl]);
    }
}
