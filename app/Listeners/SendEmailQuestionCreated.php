<?php

namespace App\Listeners;

use App\Events\QuestionCreatedEvent;
use App\Mail\QuestionCreatedMail;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailQuestionCreated
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
     * @param  QuestionCreatedEvent  $event
     * @return void
     */
    public function handle(QuestionCreatedEvent $event)
    {
        Mail::to(env('APP_MAIL_ADMIN'))->send(new QuestionCreatedMail($event->question));
    }
}
