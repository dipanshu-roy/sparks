<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Genrateurl;
use App\Models\SchoolRegistration;
use Illuminate\Http\Request;

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
        
        // Manually add the additional fields after validation
        $validated['school_url'] = "https://sspl20.com/SO" . $validated['registration_id'];
        $validated['status'] = 0;        
        $registration = Genrateurl::create($validated);

        $sch_id="sosch".date("Y").$validated['registration_id'];
        SchoolRegistration::where('id', $validated['registration_id'])
        ->update([
            'password' => '$2y$12$DzUHt4jzTqKtGWmnEqcaaOVQBAHDEhhZo5UWzBll4JioxOCUAphom',
            'school_id' => $sch_id
        ]);

      //  date("Y")
      //  session()->flush();
        return view('web.thankyou', [
            'schoolUrl' => env('APP_URL').'school-login',
            'schoolId' => $sch_id,
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
