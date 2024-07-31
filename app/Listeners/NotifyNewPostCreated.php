<?php

namespace App\Listeners;

use App\Mail\MaiolNewPostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NotifyNewPostCreated
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        Mail::to('admin@hotmail.com')
        ->send(new MaiolNewPostCreated());
    }
}
