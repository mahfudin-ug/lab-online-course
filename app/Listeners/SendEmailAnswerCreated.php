<?php

namespace App\Listeners;

use App\Events\AnswerCreatedEvent;
use App\Mail\AnswerCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailAnswerCreated
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
     * @param  AnswerCreatedEvent  $event
     * @return void
     */
    public function handle(AnswerCreatedEvent $event)
    {
        Mail::to($event->answer->question->user)->send(new AnswerCreatedMail($event->answer));
    }
}
