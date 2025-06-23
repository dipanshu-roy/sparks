<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Genrateurl;
use App\Models\SchoolRegistration;
use Illuminate\Http\Request;
use App\Models\SchoolDetails;
class GenrateController extends Controller
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
        $validated = $request->validate([
            'registration_id' => 'required|string|max:255',
        ]);
        
        $school = SchoolDetails::where('registration_id',$validated['registration_id'])->first();
        $school_code = 'so'.$school->state_id.date('y').str_pad(SchoolDetails::count(), 4, '0', STR_PAD_LEFT);

        $validated['school_url'] = url('school-login/'.$school_code);
        $validated['status'] = 0;        
        $registration = Genrateurl::firstOrCreate(
            ['registration_id' => $validated['registration_id']],
            $validated
        );

     //   $sch_id="sosch".date("Y").$validated['registration_id'];
        SchoolRegistration::where('id', $validated['registration_id'])
        ->update([
            'password' => '$2y$12$DzUHt4jzTqKtGWmnEqcaaOVQBAHDEhhZo5UWzBll4JioxOCUAphom',
            'school_id' =>  $school_code
        ]);

      //  date("Y")
      //  session()->flush();
        return view('web.thankyou', [
            'schoolUrl' => $validated['school_url'],
            'schoolId' =>  $school_code,
            'tempPassword' => '12345678'
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function show(Genrateurl $genrateurl)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genrateurl $genrateurl)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genrateurl $genrateurl)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genrateurl $genrateurl)
    {
        //
    }
}
