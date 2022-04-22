<?php

namespace App\Http\Controllers\Mark;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Term;
use App\Models\UserRole;
use App\Models\StudentMark;
use Carbon\Carbon;

/**
 * Controller containing logic for student marks
 */
class MarkController extends Controller
{
    /**
     * view method for marks list
     */
    public function index() {
        try {
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
                    'created_on' => Carbon::createFromFormat("Y-m-d H:i:s", $mark->updated_at)->format("M d, Y h:i A")
                ));
            }
            return view('Marks.view_marks', [
                'markData' => $markData
            ]);
        } catch (Exception $exception) {
            return ($exception->getMessage());
        }
    }

    /**
     * Action to add marks
     */
    public function addMarks() {
        try {
            $userRole = UserRole::where('role', 'student');
            $students = User::where('role', $userRole->value('id'))->get();
            $noOfTerms = Term::where('termname', '!=' ,null)->first();
            
            return view('Marks.add_marks', [
                'students' => $students,
                'terms' => $noOfTerms
            ]);
        } catch (Exception $exception) {
            return ($exception->getMessage());
        }
        
    }

    /**
     * Action to save marks
     */
    public function saveMarks(Request $request) {
        try {
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
        } catch (Exception $exception) {
            return ($exception->getMessage());
        }
        
    }

    /**
     * Action to edit marks
     */
    public function editMarks(Request $request, $id) {
        try {
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
        } catch (Exception $exception) {
            return ($exception->getMessage());
        }
    }

    /**
     * Action to update marks
     */
    public function updateMarks(Request $request, $id) {
        try {
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
        } catch (Exception $exception) {
            return ($exception->getMessage());
        }
        
    }

    /**
     * Action to delete marks
     */
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
