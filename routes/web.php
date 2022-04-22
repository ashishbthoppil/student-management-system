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
// General routes
Route::get('/', [StudentController::class, 'index'])->name('view.students');

// Teacher routes
Route::get('/add-teacher', [TeacherController::class, 'addTeacher'])->name('add.teacher');
Route::post('/save-teacher', [TeacherController::class, 'saveTeacher'])->name('save.teacher');

// Student routes
Route::get('/add-student', [StudentController::class, 'addStudent'])->name('add.student');
Route::post('/save-student', [StudentController::class, 'saveStudent'])->name('save.student');
Route::get('/edit-student/{id}', [StudentController::class, 'editStudent'])->name('edit.student');
Route::post('/update-student/{id}', [StudentController::class, 'updateStudent'])->name('update.student');
Route::get('/delete-student/{id}', [StudentController::class, 'deleteStudent'])->name('delete.student');
