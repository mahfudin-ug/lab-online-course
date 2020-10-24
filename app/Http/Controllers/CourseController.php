<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Resources\CourseResource;
use App\Instructor;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $currentUser = \Auth::user();

        if ($currentUser == null) {
            return response([], 401);
        }

        $courses = [];
        if ($currentUser->role === User::ROLE_INSTRUCTOR) {
            $courses = $currentUser->instructor->courses->load('instructor', 'contents');
        }
        if ($currentUser->role === User::ROLE_STUDENT) {
            $courses = $currentUser->student->courses->load('instructor', 'contents');
            // TODO need relation
        }

        return CourseResource::collection($courses);
    }

    public function popularIndex()
    {
        $courses = Course::where('featured', 1)
            ->orderBy('created_at', 'desc')
            ->with('instructor')
            ->withCount('contents')
            ->get()
            ->take(4);

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
            'started_at' => Carbon::now(),
            'ended_at' => Carbon::now()->addDay(15),
            'instructor_id' => auth()->user()->instructor->id,
        ]);

        // OPT: event(new CourseCreatedEvent($course));

        return new CourseResource($course);
    }

    public function show(Course $course)
    {

        $course->load('contents', 'instructor', 'students');

        $relatedUsers = $course->students->pluck('user_id')->toArray();
        array_push($relatedUsers, $course->instructor->user_id);
        $course->related_users = $relatedUsers;

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

    public function register(Course $course)
    {
        $student = \Auth::user()->student;

        if ($student == null) {
            return response([], 401);
        }
        $newCourse = $student->courses()->save($course);

        return new CourseResource($newCourse);
    }
}
