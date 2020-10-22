<?php

namespace App\Http\Controllers;

use App\Events\QuestionCreatedEvent;
use App\Http\Resources\QuestionResource;
use App\Question;
use App\User;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::orderBy('created_at', 'desc')->withCount('answers')->get();

        return QuestionResource::collection($questions);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:191'],
            'desc' => ['required', 'string', 'min:5'],
        ]);

        $question = Question::create([
            'title' => $request->title,
            'desc' => $request->desc,
            // 'user_id' => auth()->user()->id,
            'user_id' => User::all()->random()->id,
        ]);

        event(new QuestionCreatedEvent($question));

        return new QuestionResource($question);
    }

    public function show(Question $question)
    {
        $question->load('answers');
        return new QuestionResource($question);
    }

    public function update(Request $request, Question $question)
    {
        $request->validate([
            'title' => ['string', 'min:5', 'max:191'],
            'desc' => ['string', 'min:5'],
        ]);

        if (!$request->all()) {
            return response('No parameter', 422);
        }

        $question->update([
            'title' => $request->input('title', $question->title),
            'desc' => $request->input('desc', $question->desc),
        ]);

        return new QuestionResource($question);
    }

    public function destroy(Question $question)
    {
        $questionOld = $question;
        $question->delete();

        $message = ['message' => "$questionOld->title has deleted"];
        return response()->json($message, 200);
    }

    public function toggleStar(Question $question)
    {
        $question->update([
            'featured' => !$question->featured
        ]);

        return new QuestionResource($question);
    }
}
