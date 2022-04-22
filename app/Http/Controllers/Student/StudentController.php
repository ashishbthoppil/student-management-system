<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRole;

class StudentController extends Controller
{
    public function index() {
        try {
            $studentData = [];
            $userRole = UserRole::where('role', 'student');
            $students = User::where('role', $userRole->value('id'))->get();
            foreach($students as $student) {
                $teacher = User::where('id', $student->teacher);
                array_push($studentData, array(
                    'id' => $student->id,
                    'name' => $student->name,
                    'age' => $student->age,
                    'gender' => $student->gender == "M" ? "Male" : "Female",
                    'reporting_teacher' => $teacher->value('name')
                ));
            }
            return view('homepage', [
                'studentDatas' => $studentData
            ]);
        } catch (Exception $exception) {
            return ($exception->getMessage());
        }
    }

    public function addStudent() {
        $userRole = UserRole::where('role', 'teacher');
        $teachers = User::where('role', $userRole->value('id'))->get();
        return view('Student.add_student', [
            'teachers' => $teachers
        ]);
    }

    public function saveStudent(Request $request) {
        try {
            $validate = $request->validate([
                'student_name' => 'required|max:255',
                'age' => 'required|gt:5|lt:30',
                'gender' => 'required',
                'reporting_teacher' => 'required'
            ]);
    
            $userRole = UserRole::where('role', 'student');
            
            $student = new User;
            $student->name = $request->input('student_name');
            $student->age = $request->input('age');
            $student->gender = $request->input('gender');
            $student->teacher = $request->input('reporting_teacher');
            $student->role = $userRole->value('id');
            $student->save();
            return redirect()->route('view.students');
        } catch (Exception $exception) {
            return ($exception->getMessage());
        }
    }

    public function editStudent(Request $request, $id) {
        $studentData = [];
        $userRole = UserRole::where('role', 'teacher');
        $teachers = User::where('role', $userRole->value('id'))->get();
        $student = User::where('id', $id);
        $studentData = [
            'id' => $student->value('id'),
            'name' => $student->value('name'),
            'age' => $student->value('age'),
            'gender' => $student->value('gender'),
            'reporting_teacher' => $student->value('teacher')
        ]; 
            
        return view('Student.add_student', [
            'teachers' => $teachers,
            'studentData' => $studentData
        ]);
    }

    public function updateStudent(Request $request, $id) {
        $validate = $request->validate([
            'student_name' => 'required|max:255',
            'age' => 'required|gt:5|lt:30',
            'gender' => 'required',
            'reporting_teacher' => 'required'
        ]);
        if($request->isMethod('post') && isset($id)) {
            $student = User::find($id);
            $student->name = $request->input('student_name');
            $student->age = $request->input('age');
            $student->gender = $request->input('gender');
            $student->teacher = $request->input('reporting_teacher');
            $student->save();
            return redirect()->route('view.students');
        }
    }

    public function deleteStudent($id) {
        try {
            if(isset($id)) {
                $student = User::find($id);
                $student->delete();
                return redirect()->route('view.students');
            }
        } catch (Exception $exception) {
            return ($exception->getMessage()); 
        }
    }
}
