<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRole;

/**
* Controller teachers logic
*/
class TeacherController extends Controller
{
    /**
     * Action to add teachers
     */
    public function addTeacher(Request $request) {
        try {
            $userRole = UserRole::where('role', 'teacher');
            $teachers = User::where('role', $userRole->value('id'))->get();
            return view('Teacher.add_teacher', [
                'teachers' => $teachers
            ]);
        } catch (Exception $exception) {
            return ($exception->getMessage());
        }
    }

    /**
     * Action to save teachers
     */
    public function saveTeacher(Request $request) {
        try {
            $validate = $request->validate([
                'teacher_name' => 'required|max:255',
                'age' => 'required|gt:5|lt:30',
                'gender' => 'required'
            ]);
    
            $userRole = UserRole::where('role', 'teacher');
            
            $teacher = new User;
            $teacher->name = $request->input('teacher_name');
            $teacher->age = $request->input('age');
            $teacher->gender = $request->input('gender');
            $teacher->role = $userRole->value('id');
            $teacher->save();
            return redirect()->route('add.teacher');
        } catch (Exception $exception) {
            return ($exception->getMessage());
        }
    }
}
