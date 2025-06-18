<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Headofschool;
use Illuminate\Http\Request;

class HeadofSchoolController extends Controller
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
        if(isset($request->mobile)){
            $request->validate([
                'mobile' => [
                    'required',
                    function ($attribute, $value, $fail) { 
                        $isMobile = preg_match('/^[6-9][0-9]{9}$/', $value);            
                        if (!$isMobile) {
                            if (is_numeric($value)) {
                                if (!preg_match('/^[0-9]{10}$/', $value)) {
                                    $fail('The mobile number must be exactly 10 digits.');
                                } elseif (!preg_match('/^[6-9]/', $value)) {
                                    $fail('Invalid mobile number.');
                                } else {
                                    $fail('Invalid email address.');
                                }
                            } else {
                                $fail('Invalid email address.');
                            }
                        }
                    },
                ],
            ]);
        }
        $request->validate([
        'title_id'     => 'required|integer',
        'first_name'   => 'required|string|max:255',
        'designation'  => 'required|string|max:255',
        ], [
            'mobile.required' => 'Invalid mobile number.',
        ]);
        $data = [
            'title_id'        => $request->title_id,
            'first_name'      => $request->first_name,
            'last_name'       => $request->last_name,
            'second_name'     => $request->second_name,
            'email'           => $request->email,
            'mobile'          => $request->mobile,
            'designation'     => $request->designation,
        ];
        Headofschool::updateOrCreate(
            ['registration_id' => $request->registration_id],
            $data
        );
        return redirect()->route('spark.cordinator')->with('success', "Head of school registered successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Headofschool $headofschool)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Headofschool $headofschool)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Headofschool $headofschool)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Headofschool $headofschool)
    {
        //
    }
}
