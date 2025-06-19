<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Clases;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $cc = Clases::get();
        $st = new Student();
        $st->school_id     = $request->school_id;
        $st->admission_no  = $request->admno;
        $st->save();
        $admission_no = $request->admno;
        return view('web.student_register',compact('admission_no','cc'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name'     => 'required|string|max:255',
            'father_name'   => 'required|string|max:255',
            'class'         => 'required|string|max:50',
            'section'       => 'required|string|max:50',
            'admission_no'  => 'required|string|max:50', // include this in validation
        ]);
        $student = Student::where('admission_no', $request->admission_no)->first();

        if ($student) {
            // Update existing record
            $student->update([
                'full_name'     => $validated['full_name'],
                'father_name'   => $validated['father_name'],
                'class'         => $validated['class'],
                'section'       => $validated['section'],
            ]);        
            //return redirect()->back()->with('success', 'Student info saved!');
            return redirect()->route('register.successfully')->with('success', 'Student record updated successfully.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function register_successfully(Student $student)
    {
        return view('web.student_register_thankyou');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
