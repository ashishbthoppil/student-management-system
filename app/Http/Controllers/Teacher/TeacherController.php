<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRole;

class TeacherController extends Controller
{
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
            return redirect()->route('view.students');
        } catch (Exception $exception) {
            return ($exception->getMessage());
        }
    }
}
