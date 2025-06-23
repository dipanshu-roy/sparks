<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Clases;
use App\Models\GenrateLink;
use App\Models\SchoolRegistration;
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
        // Check if student already exists
             $existingStudent = Student::where('school_id', $request->school_id)
             ->where('admission_no', $request->admno)
             ->first();

            //  if ($existingStudent) {
            //     return back()->withErrors(['admno' => 'This admission number is already registered for this school.'])->withInput();
            //  }

        // Proceed to save if not exists
        $cc = Clases::get();
        $st = new Student();
        $st->school_id     = $request->school_id;
        $st->admission_no  = $request->admno;
        $st->save();

        $admission_no = $request->admno;
        return view('web.student_register', compact('admission_no', 'cc'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
      
         try {
            // Validate request
            $validated = $request->validate([
                'full_name'       => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
                'father_name'     => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
                'class'           => 'required|string|max:50',
                'section'         => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
                'mobile'          => 'nullable|string|max:20',
                'email'           => 'nullable|email|max:255',        
                'subject_id'      => 'array|required'
            ]);

     
    
    
    // Try to find the student by admission_no
         $student = Student::where('admission_no', $request->admission_no)->first();
        $scid = SchoolRegistration::where('school_id', $student->school_id)->first();
        $examdate = GenrateLink::where('school_id', $scid->id)->first();

       
        if ($student) {
            // Update existing record
            $student->update([
                'full_name'     => $request->input('full_name'),
                'father_name'   => $request->input('father_name'),
                'class'         => $request->input('class'),
                'section'       => $request->input('section'), 
                'mobile'        => $request->input('mobile'),
                'email'         => $request->input('email'),
                'middle_name'   => $request->input('middle_name'),
                'last_name'     => $request->input('last_name'),
                'subject_id'    => implode(',', $request->input('subject_id')),
                'exam_date'     => $examdate->date_id,
            ]);    
                                  
            //return redirect()->back()->with('success', 'Student info saved!');
             return redirect()->route('register.successfully')->with('success', 'Student record updated successfully.');
        }  
      } catch (\Exception $e) {
                //print_r($e->getMessage());
                return redirect()->back()->with('error', $e->getMessage());
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
