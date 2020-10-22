<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Resources\CourseResource;
use App\Instructor;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::orderBy('created_at', 'desc')->withCount('contents')->get();

        return CourseResource::collection($courses);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:191', 'unique:courses,title'],
            'desc' => ['required', 'string', 'min:5'],
        ]);

        $course = Course::create([
            'title' => $request->title,
            'slug' => \Str::slug($request->title),
            'desc' => $request->desc,
            // 'instructor_id' => auth()->user()->id,
            'instructor_id' => Instructor::all()->random()->id,
        ]);

        // OPT: event(new CourseCreatedEvent($course));

        return new CourseResource($course);
    }

    public function show(Course $course)
    {

        $course->load('contents');
        return new CourseResource($course);
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => ['string', 'min:5', 'max:191'],
            'desc' => ['string', 'min:5'],
        ]);

        if (!$request->all()) {
            return response('No parameter', 422);
        }

        $course->update([
            'title' => $request->input('title', $course->title),
            'slug' => $request->has('title') ? \Str::slug($request->title) : $course->slug,
            'desc' => $request->input('desc', $course->desc),
        ]);

        return new CourseResource($course);
    }

    public function destroy(Course $course)
    {
        $courseOld = $course;
        $course->delete();

        $message = ['message' => "$courseOld->title has deleted"];
        return response()->json($message, 200);
    }
}
