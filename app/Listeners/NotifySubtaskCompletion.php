<?php

namespace App\Listeners;

use App\Events\SubtaskCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification as FacadesNotification;

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
        FacadesNotification::send($user, new SubtaskCompleted($event->subtask));
    }
}
