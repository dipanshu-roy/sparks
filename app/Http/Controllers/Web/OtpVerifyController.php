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
        if (!is_null($request->mobileno)) {          
            $request->validate([
                'otp' => 'required|numeric',
            ]);
            $request->session()->forget('schoolid');
            
            $school = Otp::where('source',$request->mobileno)
            ->where('otp',$request->otp)
            ->where('status',0)->where('validate',0)->first();
            if(!$school){
                return response()->json(['status'=>404,'otp'=>'verify','message' => 'Invalid OTP. Try again.']);           
            }
            if ($request->otp == $school->otp) {
                $schoolid = Otp::where('source',$request->mobileno)->where('status',0)->where('validate',0)->update([
                    'status' => 1,
                    'validate' => 1
                ]);

                Session::put('schoolid', $school->registration_id);
                return response()->json(['status'=>200,'otp'=>'verify','message' => 'OTP Verified!','route'=>route('school.create')]);
            }
            return response()->json(['status'=>404,'otp'=>'verify','message' => 'Invalid OTP. Try again']);
        }else{

            return response()->json(['status'=>404,'otp'=>'verify','message' => 'Verification failed please start again']);
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
