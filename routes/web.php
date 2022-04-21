<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Teacher\TeacherController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [StudentController::class, 'index'])->name('view.students');

Route::get('/add-student', [StudentController::class, 'addStudent'])->name('add.student');
Route::get('/add-teacher', function () {
    return view('Teacher.add_teacher');
})->name('add.teacher');
Route::post('/save-teacher', [TeacherController::class, 'saveTeacher'])->name('save.teacher');
Route::post('/save-student', [StudentController::class, 'saveStudent'])->name('save.student');
