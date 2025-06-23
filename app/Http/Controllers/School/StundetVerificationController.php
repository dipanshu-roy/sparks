<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use DB;
use Illuminate\Support\Facades\Auth;
class StundetVerificationController extends Controller
{
    public function index(){

        // $students = \DB::table('students')
        // ->join('class', 'class.id', '=', 'students.class')
        // ->join('subject', function ($join) {
        //     $join->on(\DB::raw('FIND_IN_SET(subject.id, students.subject_id)'), '>', \DB::raw('0'));
        // })
        // ->select('students.*', 'class.name as class_name', 'subject.name as subject_name')
        // ->orderBy('students.id', 'desc')
        // ->get();

        
        $user = Auth::guard('school')->user();

        $students = DB::table('students')
            ->select(
                'students.admission_no',
                'students.full_name',
                'students.middle_name',
                'students.last_name',
                'students.section',
                'class.name as class_name',
                'exam_shedule.exam_fee',
                'exam_shedule.discount',
                DB::raw('GROUP_CONCAT(subject.name ORDER BY subject.name SEPARATOR ", ") as subject_names')
            )
            ->leftJoin('subject', function($join) {
                $join->on(DB::raw('FIND_IN_SET(subject.id, students.subject_id)'), '>', DB::raw('0'));
            })
            ->leftJoin('class', 'class.id', '=', 'students.class')
            ->leftJoin('exam_shedule', 'exam_shedule.id', '=', 'students.class')
            ->where('students.school_id', $user->school_id) // ← This is the added line
            ->groupBy('students.id')
            ->get();

            $total_student=count($students);
        
        return view('school.studenlist',compact('students','total_student'));
    }


    public function destroy($id){
        $student = Student::findOrFail($id);    
        $student->delete();
        return back()->with('success', 'Student deleted successfully!');
    }


}
