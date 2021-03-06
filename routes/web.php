<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Mark\MarkController;

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
Route::get('/add-terms', [StudentController::class, 'addTerms'])->name('add.terms');
Route::post('/save-terms', [StudentController::class, 'saveTerms'])->name('save.terms');

// Mark routes
Route::get('/view-marks', [MarkController::class, 'index'])->name('view.marks');
Route::get('/add-marks', [MarkController::class, 'addMarks'])->name('add.marks');
Route::post('/save-marks', [MarkController::class, 'saveMarks'])->name('save.marks');
Route::get('/edit-marks/{id}', [MarkController::class, 'editMarks'])->name('edit.marks');
Route::get('/delete-marks/{id}', [MarkController::class, 'deleteMarks'])->name('delete.marks');
Route::post('/update-marks/{id}', [MarkController::class, 'updateMarks'])->name('update.marks');
