<?php

namespace App\Mail;

use App\Models\Hero;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HeroCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;


    public $hero;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Hero $hero)
    {
        $this->hero = $hero;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Eroe creato')
            ->markdown('emails.heroes.created');
    }
}
