<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Events\AnswerCreatedEvent;
use App\Http\Resources\AnswerResource;
use App\Question;
use App\User;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function store(Request $request, Question $question)
    {
        $request->validate([
            'answer' => ['required', 'string', 'min:5'],
        ]);

        $answer = Answer::create([
            'answer' => $request->answer,
            'question_id' => $question->id,
            // 'user_id' => auth()->user()->id,
            'user_id' => User::all()->random()->id,
        ]);

        event(new AnswerCreatedEvent($answer));

        return new AnswerResource($answer);

    }

    public function update(Request $request, Answer $answer)
    {
        $request->validate([
            'answer' => ['string', 'min:5'],
        ]);

        $answer->update([
            'answer' => $request->input('answer', $answer->answer),
        ]);


        return new AnswerResource($answer);
    }

    public function destroy(Answer $answer)
    {
        $answer->delete();

        $message = ['message' => "Answer has deleted"];
        return response()->json($message, 200);

    }
}
