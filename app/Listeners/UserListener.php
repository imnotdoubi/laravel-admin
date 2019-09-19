<?php

namespace App\Listeners;

use App\Events\UserEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserListener implements ShouldQueue
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
     * @param  PvEvent $event
     * @return void
     */
    public function handle(UserEvent $event)
    {
        $log = new \App\Models\Web\UserLog();
        $log->user_id = $event->obj->id;
        $log->ip = request()->ip();
        $log->save();
    }
}
