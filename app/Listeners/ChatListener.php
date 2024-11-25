<?php

namespace App\Listeners;

use App\Events\ChatSender;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class ChatListener
{
    /**
     * Create the event listener.
     */

    public function __construct($data)
    {
    }

    /**
     * Handle the event.
     */
    public function handle(): void
    {
    }
}
