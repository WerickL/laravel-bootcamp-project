<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use App\Models\User;
use App\Notifications\NewTask;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Throwable;

class SendTaskCreatedNotifications implements ShouldQueue
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
    public function handle(TaskCreated $event): void
    {
        foreach (User::all() as $user) {
            $user->notify(new NewTask($event->task->description));
          
        }
    }
    public function failed(TaskCreated $event, Throwable $exception): void
    {
        print_r($exception->getMessage());
    }
}
