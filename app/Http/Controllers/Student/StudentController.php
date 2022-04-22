<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Term;
use App\Models\UserRole;

/**
* Controller containing student logic
*/
class StudentController extends Controller
{
    /**
     * Action to view students
     */
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

    /**
     * Action to add students
     */
    public function addStudent() {
        $userRole = UserRole::where('role', 'teacher');
        $teachers = User::where('role', $userRole->value('id'))->get();
        return view('Student.add_student', [
            'teachers' => $teachers
        ]);
    }

    /**
     * Action to save students
     */
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

    /**
     * Action to edit students
     */
    public function editStudent(Request $request, $id) {
        try {
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
        } catch (Exception $exception) {
            return ($exception->getMessage()); 
        }
    }

    /**
     * Action to update students
     */
    public function updateStudent(Request $request, $id) {
        try {
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
        } catch (Exception $exception) {
            return ($exception->getMessage()); 
        }
    }

    /**
     * Action to delete students
     */
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

    /**
     * Action to add terms
     */
    public function addTerms(Request $request) {
        try {
            $term = Term::where('termname', '!=' ,null)->first();
            return view('Student.add_terms', [
                'term' => $term
            ]);
        } catch (Exception $exception) {
            return ($exception->getMessage()); 
        }
    }

    /**
     * Action to save terms
     */
    public function saveTerms(Request $request) {
        try {
            $validate = $request->validate([
                'terms' => 'required|gt:0|lte:10'
            ]);
            
            if(!Term::count()) {
                $term = new Term;
                $term->termname = $request->input('terms');
                $term->save();
            } else {
                $term = Term::where('termname', '!=' ,null)->update(['termname' => $request->input('terms')]);
            }
            $noOfTerms = Term::where('termname', '!=' ,null)->first();

            return view('Student.add_terms', [
                'term' => $noOfTerms
            ]);
        } catch (Exception $exception) {
            return ($exception->getMessage()); 
        }
    }
}
