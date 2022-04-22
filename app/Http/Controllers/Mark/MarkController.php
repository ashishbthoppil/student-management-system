<?php

namespace App\Http\Controllers\Mark;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Term;
use App\Models\UserRole;
use App\Models\StudentMark;

class MarkController extends Controller
{
    public function index() {
        $markData = [];
        $marks = StudentMark::all();
        foreach($marks as $mark) {
            $student = User::where('id', $mark->student);
            array_push($markData, array(
                'id' => $mark->id,
                'name' => $student->value('name'),
                'math' => $mark->math,
                'science' => $mark->science,
                'history' => $mark->history,
                'term' => $mark->term,
                'total_marks' => $mark->math + $mark->science + $mark->history,
                'created_on' => $mark->updated_at
            ));
        }
        return view('Marks.view_marks', [
            'markData' => $markData
        ]);
    }

    public function addMarks() {
        $userRole = UserRole::where('role', 'student');
        $students = User::where('role', $userRole->value('id'))->get();
        $noOfTerms = Term::where('termname', '!=' ,null)->first();
        
        return view('Marks.add_marks', [
            'students' => $students,
            'terms' => $noOfTerms
        ]);
    }

    public function saveMarks(Request $request) {
        $validate = $request->validate([
            'student' => 'required',
            'math' => 'required|gte:0|lte:100',
            'science' => 'required|gte:0|lte:100',
            'history' => 'required|gte:0|lte:100',
            'term' => 'required'
        ]);

        $studentMarks = StudentMark::where('term', $request->input('term'))->where('student', $request->input('student'));

        if($studentMarks->count()) {
            $studentMarks->update(['student' => $request->input('student'), 'math' => $request->input('math'),'science' => $request->input('science'),'history' => $request->input('history'), 'term' => $request->input('term')]);
        } else {
            $studentMark = new StudentMark;
            $studentMark->student = $request->input('student');
            $studentMark->math = $request->input('math');
            $studentMark->science = $request->input('science');
            $studentMark->history = $request->input('history');
            $studentMark->term = $request->input('term');
            $studentMark->save();
        }
    }

    public function editMarks(Request $request, $id) {
        $markData = [];

        $mark = StudentMark::find($id);
        $userRole = UserRole::where('role', 'student');
        $students = User::where('role', $userRole->value('id'))->get();
        $noOfTerms = Term::where('termname', '!=' ,null)->first();
        $markData = [
            'id' => $mark->id,
            'student' => $mark->student,
            'math' => $mark->math,
            'science' => $mark->science,
            'history' => $mark->history,
            'term' => $mark->term
        ]; 
            
        return view('Marks.add_marks', [
            'students' => $students,
            'terms' => $noOfTerms,
            'markData' => $markData
        ]);
    }

    public function updateMarks(Request $request, $id) {
        $validate = $request->validate([
            'student' => 'required',
            'math' => 'required|gte:0|lte:100',
            'science' => 'required|gte:0|lte:100',
            'history' => 'required|gte:0|lte:100',
            'term' => 'required'
        ]);

        if($request->isMethod('post') && isset($id)) {
            $mark = StudentMark::find($id);
            $mark->student = $request->input('student');
            $mark->math = $request->input('math');
            $mark->science = $request->input('science');
            $mark->history = $request->input('history');
            $mark->term = $request->input('term');
            $mark->save();
            return redirect()->route('view.marks');
        }
    }

    public function deleteMarks($id) {
        try {
            if(isset($id)) {
                $mark = StudentMark::find($id);
                $mark->delete();
                return redirect()->route('view.marks');
            }
        } catch (Exception $exception) {
            return ($exception->getMessage()); 
        }
    }
}
