<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Schoolenrolment;
use Illuminate\Http\Request;

class SchollenrolmentController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'registration_id' => 'required|integer',
            'total_enrollment' => 'required|integer',
            'class_1_to_8_enroll' => 'required|integer',
            'total_com_labs' => 'required|integer',
        ]);

        $sr = \App\Models\Schoolenrolment::updateOrCreate(
            ['registration_id' => $request->registration_id],
            [
                'total_enrollment'     => $request->total_enrollment,
                'class_1_to_8_enroll'  => $request->class_1_to_8_enroll,
                'total_com_labs'       => $request->total_com_labs,
            ]
        );
        \App\Models\LabsDetails::where('registration_id', $request->registration_id)->delete();
        $labs = $request->input('labs', []);
        foreach ($labs as $index => $lab) {
            \App\Models\LabsDetails::create([
                'labs_name'       => 'Lab' . $index,
                'registration_id' => $request->registration_id,
                'computer_qty'    => isset($lab['capacity']) ? intval($lab['capacity']) : 0,
            ]);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'School Enrollment Successfully.',
            'redirect_url' => route('finel.save'),
            'validate_details' => $request->registration_id,
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Schoolenrolment $schoolenrolment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schoolenrolment $schoolenrolment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schoolenrolment $schoolenrolment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schoolenrolment $schoolenrolment)
    {
        //
    }
}
