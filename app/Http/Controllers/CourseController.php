<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Models\Category;
use App\Models\Course;

class CourseController extends Controller
{
    public function index(){
        return view('courses.index', ['courses' => Course::FrontEndCourse()->with('teacher:id,name,image,slug', 'students:id')->where('status', 'Enabled')->paginate(6)]);
    }

    public function single(Course $course)
    {
        return view('courses.single', [
            'related_courses' => Course::FrontEndCourse()->with('teacher:id,name,image,slug')->where('category_id', $course->category_id)->where('id', '!=', $course->id)->inRandomOrder()->take(2)->get(),
            'course' => $course->load('teacher:id,name,image,slug', 'students:id', 'category:id,name,slug', 'lessons'),
            'courses_you_may_like' => Course::FrontEndCourse()->with('teacher:id,name,image,slug')->where('id', '!=', $course->id)->inRandomOrder()->take(3)->get(),
        ]);
    }

    public function create()
    {
        return view(
            'courses.create',
            [
//                'teachers' => User::Teacher()->get(['id', 'name']),
                'categories' => Category::with('parents')->whereNull('parent_id')->where('status', 'enabled')->get(['id', 'name'])
            ]
        );
    }

    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->validated());
//    if($request->hasFile('image')){
//        $dest_path = 'public/images/courses';
//        $image = $request->file('image');
//        $image_name = $image->getClientOriginalName();
//        $path = $request->file('image')->storeAs($dest_path, $image_name);
//        $course->image = $image_name;
//    }
        $course->image  = $this->uploadOrUpdateFile($request, $course->image, \constPath::CourseImage);
        $course->save();
        return redirect()->route('courses.index');
    }

    function uploadOrUpdateFile($request, $image, $path)
    {

        if ($request->hasFile('image')) {
            // update the image //
            if ($request->edit_id) {
                if (!empty($image)) {

                    $photo_path = public_path() . $path . $image;
                    unlink($photo_path);
                }
            }
            // Add New image
            $file = $request->file('image');
            $randomName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . $path, $randomName);
            $image = $randomName;
        }
        return  $image;
    }
}
