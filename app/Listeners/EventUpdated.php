<?php

namespace App\Listeners;

use App\Events\EventUpdated as EventPostUpdated;
use App\Services\Thumb;

class EventUpdated
{
    /**
     * Handle the event.
     *
     * @param  EventUpdated  $event
     * @return void
     */
    public function handle(EventPostUpdated $event)
    {
        if($event->model->wasChanged ('image')) {
            Thumb::makeThumb ($event->model);
        }
    }
}
