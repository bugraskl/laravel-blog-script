<?php

namespace App\Jobs;

use App\Mail\PostPublished;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPostToSubscribers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $postUrl;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($postUrl)
    {
        $this->postUrl = $postUrl;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Tüm subscriberlara mail gönder
        $subscribers = Subscriber::all();
        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new PostPublished($this->postUrl));
        }
    }
}
