<?php

use App\Http\Controllers\LessonController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/Courses/create', [CourseController::class, 'create'])->name('courses.create');
Route::get('/Courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/Courses/{course}', [CourseController::class, 'single'])->name('courses.single');
Route::put('/Courses', [CourseController::class, 'store'])->name('courses.store');

Route::get('/lessons/create/{slug}', [LessonController::class, 'create'])->name('lessons.create');
Route::post('/lessons', [LessonController::class, 'store'])->name('lessons.store');
Route::post('/image-upload', [LessonController::class, 'image-upload'])->name('lessons.image-upload');
