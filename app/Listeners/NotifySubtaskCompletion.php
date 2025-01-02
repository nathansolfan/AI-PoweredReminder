<?php

namespace App\Listeners;

use App\Events\SubtaskCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;

class NotifySubtaskCompletion
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
        // Send a notification to the user
        $user = $event->subtask->task->user();
        Notification::send($user, new SubtaskCompleted($event->subtask));
    }
}
