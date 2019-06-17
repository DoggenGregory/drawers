<?php

namespace App\Listeners\app\listeners;

use App\Events\app\Events\newMessage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class printMessage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  newMessage  $event
     * @return void
     */
    public function handle(newMessage $event)
    {
        //
    }
}
