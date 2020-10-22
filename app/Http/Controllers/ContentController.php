<?php

namespace App\Http\Controllers;

use App\Content;
use App\Course;
use App\Http\Resources\ContentResource;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:191', 'unique:contents,title'],
            'desc' => ['required', 'string', 'min:5'],
        ]);

        $content = Content::create([
            'title' => $request->title,
            'slug' => \Str::slug($request->title),
            'desc' => $request->desc,
            'course_id' => $course->id,
        ]);

        return new ContentResource($content->load('course'));
    }

    public function show(Content $content)
    {

        return new ContentResource($content->load('course'));
    }

    public function update(Request $request, Content $content)
    {
        $request->validate([
            'title' => ['string', 'min:5', 'max:191'],
            'desc' => ['string', 'min:5'],
        ]);

        if (!$request->all()) {
            return response('No parameter', 422);
        }

        $content->update([
            'title' => $request->input('title', $content->title),
            'slug' => $request->has('title') ? \Str::slug($request->title) : $content->slug,
            'desc' => $request->input('desc', $content->desc),
        ]);

        return new ContentResource($content);
    }

    public function destroy(Content $content)
    {
        $contentOld = $content;
        $content->delete();

        $message = ['message' => "$contentOld->title has deleted"];
        return response()->json($message, 200);
    }
}
