<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLessonRequest;
use App\Models\Course;
use App\Models\Lesson;

class LessonController extends Controller
{
    public function create($slug)
    {
        return view('lessons.create', ['course' => Course::whereSlug($slug)->first()]);
    }

    public function store(StoreLessonRequest $request)
    {
        $lesson = Lesson::create($request->validated());
        $lesson->image  = uploadOrUpdateFile($request, $lesson->image, \constPath::LessonVideo);
        $lesson->save();
        return redirect()->route('courses.single', [$request->course_id]);
    }
}
