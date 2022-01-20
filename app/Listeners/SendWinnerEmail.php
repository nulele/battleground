<?php

namespace App\Listeners;

use App\Events\HeroWon;
use App\Mail\HeroCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendWinnerEmail implements ShouldQueue
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
     * @param  \App\Events\HeroWon  $event
     * @return void
     */
    public function handle(HeroWon $event)
    {
        Mail::to($event->hero->user->email)->send(new \App\Mail\HeroWon($event->hero));

    }
}
