<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\WaitingForApprovalNotification;

class SendApprovalNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(Verified $event)
    {
        $user = $event->user;
        $user->notify(new WaitingForApprovalNotification());

    }
}
