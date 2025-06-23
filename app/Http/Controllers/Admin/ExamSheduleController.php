<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ExamShedule;
use Illuminate\Http\Request;
use App\Models\Clases;
use App\Models\Subject;
use DB;
class ExamSheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $dates = DB::table('exam_shedule')
        ->select(
            'exam_shedule.id',
            'exam_shedule.shedule_date as shedule_date','exam_end_date','exam_fee','discount',
            DB::raw('GROUP_CONCAT(class.name ORDER BY class.name SEPARATOR ", ") as class_names')
        )
        ->leftJoin('class', function($join) {
            $join->on(DB::raw('FIND_IN_SET(class.id, exam_shedule.class_id)'), '>', DB::raw('0'));
        })
        ->groupBy('exam_shedule.id')
        ->get();
        return view('admin.exam-date.view',compact('dates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $clases=Clases::get();
        
        return view('admin.exam-date.add',compact('clases'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         try {
                $validated = $request->validate([
                    'shedule_date' => 'required|date',
                    'class_id' => 'required|array',                  
                    'exam_end_date' => 'required|date',
                    'exam_fee' => 'required|numeric',
                    'discount' => 'required|numeric',
                ]);
            
                $examSchedule = new ExamShedule();
                $examSchedule->shedule_date = $validated['shedule_date'];
                $examSchedule->class_id = implode(',', $validated['class_id']); 
                $examSchedule->exam_end_date = $validated['exam_end_date'];
                $examSchedule->exam_fee = $validated['exam_fee'];
                $examSchedule->save();
            
                return redirect()->back()->with('success', 'Exam created successfully.');
        } catch (\Exception $e) {
               //print_r($e->getMessage());
                return redirect()->back()->with('error', 'An error occurred while registering. Please try again.');
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(ExamShedule $examShedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {   
         $edit = ExamShedule::find($id);
         $clases=Clases::get();
        return view('admin.exam-date.edit',compact('clases','edit'));       
 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                 'class_id' => 'required|array',
                 'exam_end_date' => 'date',
                 'shedule_date' => 'date',
                 'exam_fee' => 'required|numeric',
            ]);
        
            $subject = ExamShedule::findOrFail($id);
            $subject->shedule_date = $request->shedule_date;
            $subject->exam_end_date = $request->exam_end_date;
            $subject->class_id = implode(',', $request->class_id); // save array as CSV
            $subject->exam_fee = $request->exam_fee;
            $subject->discount = $request->discount;
            $subject->save();
        
            return redirect()->route('exam.date')->with('success', 'Date updated successfully.');
              } catch (\Exception $e) {
                       // print_r($e->getMessage());
                        return redirect()->back()->with('error', $e->getMessage());
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExamShedule $examShedule)
    {
        //
    }
}
