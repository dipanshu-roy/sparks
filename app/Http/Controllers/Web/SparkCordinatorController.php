<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\SparkCordinator;
use Illuminate\Http\Request;

class SparkCordinatorController extends Controller
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
    // public function store(Request $request)
    // {

    //     if(isset($request->mobile)){
    //        $request->validate([
    //             'mobile' => [
    //                 'required',
    //                 function ($attribute, $value, $fail) { 
    //                     $isMobile = preg_match('/^[6-9][0-9]{9}$/', $value);            
    //                     if (!$isMobile) {
    //                         if (is_numeric($value)) {
    //                             if (!preg_match('/^[0-9]{10}$/', $value)) {
    //                                 $fail('The mobile number must be exactly 10 digits.');
    //                             } elseif (!preg_match('/^[6-9]/', $value)) {
    //                                 $fail('Invalid mobile number.');
    //                             } else {
    //                                 $fail('Invalid email address.');
    //                             }
    //                         } else {
    //                             $fail('Invalid email address.');
    //                         }
    //                     }
    //                 },
    //             ],
    //         ]);
    //     }
    //     if(isset($request->email)){
    //         $request->validate([
    //             'email' => ['required', 'string', 'email', 'max:255'],
    //         ]);
    //     }
    //     $request->validate([
    //         'title_id'                  => 'required|integer',
    //         'first_name'                => 'required|string|max:255',
    //        // 'last_name'                 => 'required|string|max:255',
    //        // 'second_name'               => 'nullable|string|max:255',
    //        // 'email'                     => 'required|email|max:255',
    //        // 'mobile'                    => 'required|string|max:15',
    //      //   'registration_id'          => 'required|string|max:255',
    //         'designation'              => 'required|string|max:255',
    //        // 'staff_id_based_on_school' => 'required|string|max:255|unique:staff,staff_id_based_on_school',
    //         //'is_validate'              => 'required|boolean',
    //     ]);
    //     if(isset($request->registration_id_from_admin)){
    //         $up_school = SparkCordinator::where('registration_id',$request->registration_id_from_admin)->first();
    //         $up_school->title_id          = $request->title_id;
    //         $up_school->first_name        = $request->first_name;
    //         $up_school->last_name         = $request->last_name;
    //         $up_school->second_name       = $request->second_name;
    //         $up_school->email             = $request->email;
    //         $up_school->mobile            = $request->mobile;
    //         $up_school->designation       = $request->designation; 
    //         $up_school->save();
    //         return redirect()->back()->with('success', "Spark coordinator update Successfully");
    //     }else{
    //     $school = new SparkCordinator();
    //     $school->title_id = $request->title_id;
    //     $school->first_name        = $request->first_name;
    //     $school->last_name         = $request->last_name;
    //     $school->second_name       = $request->second_name;
    //     $school->email     = $request->email;
    //     $school->mobile         = $request->mobile;
    //     $school->designation = $request->designation;
    //     $school->registration_id = $request->registration_id;
    //     $school->save();
    //     return redirect()->back()->with('success', "Spark Coordinator Registerd Successfully");
    //     }
    // }


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
        if (isset($request->email)) {
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255'],
            ]);
        }

        $request->validate([
            'title_id'     => 'required|integer',
            'first_name'   => 'required|string|max:255',
            'designation'  => 'required|string|max:255',
        ]);

        if(isset($request->registration_id_from_admin)){
            $up_school = SparkCordinator::where('registration_id',$request->registration_id_from_admin)->first();
            $up_school->title_id          = $request->title_id;
            $up_school->first_name        = $request->first_name;
            $up_school->last_name         = $request->last_name;
            $up_school->second_name       = $request->second_name;
            $up_school->email             = $request->email;
            $up_school->mobile            = $request->mobile;
            $up_school->designation       = $request->designation; 
            $up_school->save();
            return redirect()->back()->with('success', "Spark coordinator update Successfully");
        }else{
            $data = [
                'title_id'        => $request->title_id,
                'first_name'      => $request->first_name,
                'last_name'       => $request->last_name,
                'second_name'     => $request->second_name,
                'email'           => $request->email,
                'mobile'          => $request->mobile,
                'designation'     => $request->designation,
            ];
            SparkCordinator::updateOrCreate(
                ['registration_id' => $request->registration_id],
                $data
            );
            return redirect(route('school_enroll.create'))->with('success', 'Spark Coordinator Registered Successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SparkCordinator $sparkCordinator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SparkCordinator $sparkCordinator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SparkCordinator $sparkCordinator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SparkCordinator $sparkCordinator)
    {
        //
    }
}
