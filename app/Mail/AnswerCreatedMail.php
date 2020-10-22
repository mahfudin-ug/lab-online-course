<?php

namespace App\Mail;

use App\Answer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AnswerCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $answer;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Answer $answer)
    {
        $this->answer = $answer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->answer->load('question');

        return $this->from(env('APP_MAIL_NOREPLY'))
            ->markdown('mails.answer-created');
    }
}
