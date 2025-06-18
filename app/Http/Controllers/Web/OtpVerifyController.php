<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Otp;
use App\Models\SchoolRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OtpVerifyController extends Controller
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

    public function verifyOtp(Request $request){
        
        if (!is_null($request->validate_details)) {          
            $request->validate([
                'otp' => 'required|numeric',
            ]);
            $request->session()->forget('schoolid');
            
            $school = Otp::where('source',$request->validate_details)
            ->where('otp',$request->otp)
            ->where('status',0)->where('validate',0)->first();
            if(!$school){
            // if($school->status !=0 && $school->validate !=0){
                    return redirect()->back()->with('error', 'OTP Expire. Try again.');     
            // }            
            }
            
            if ($request->otp == $school->otp) {
                
                $schoolid = Otp::where('source',$request->validate_details)->where('status',0)->where('validate',0)->update([
                    'status' => 1,
                    'validate' => 1
                ]);
                Session::put('schoolid', $school->registration_id);
                return redirect()->route('school.create')->with('success', 'OTP Verified!');
            }
        
            return redirect()->route('otp.verify.form')->with([
                'validate_details' => $request->validate_details,
                'error' => 'Invalid OTP. Try again.'
            ]); 
        }else{       
            return redirect()->back()->with('error', 'Verification failed please go back and start again');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Otp $otp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Otp $otp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Otp $otp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Otp $otp)
    {
        //
    }
}
