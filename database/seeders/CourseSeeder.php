<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $course = Course::factory()
            ->count(5)
            ->create()
         ->each(function ($course) {
             $course->code = Str::substr(Str::upper($course->name), 0, 2) . rand(000000, 999999);
             $course->slug = Str::slug($course->name);
             $course->save();
         });
    }
}
