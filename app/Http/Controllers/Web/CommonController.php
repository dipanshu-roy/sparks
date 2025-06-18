<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\State;
use App\Models\District;
use App\Models\City;
use App\Models\Designation;
use App\Models\Title;
use App\Models\SchoolDetails;
use App\Models\Headofschool;
use App\Models\SparkCordinator;
use App\Models\Schoolenrolment;
use App\Models\LabsDetails;
use Illuminate\Support\Facades\Session;


class CommonController extends Controller
{
    public function index1(){
        return view('web.index1');
    }
    public function index2(){
        return view('web.index2');
    }
    public function index3(){
        $boards = Board::get();
        $states = State::get();
        $schoolid = Session::get('schoolid');
        $school = SchoolDetails::where('registration_id',$schoolid)->first();
        $city = [];
        if(!empty($school)){
            $city = District::where('districtid',$school->district_id)->get();
        }
        return view('web.index3',compact('states','boards','school','city'));
    }
    public function index4(){
        $designation = Designation::orderBy('designation','ASC')->get();
        $title = Title::get();
        $schoolid = Session::get('schoolid');
        $head_of_school = Headofschool::where('registration_id',$schoolid)->first();
        return view('web.index4',compact('designation','title','head_of_school'));
    }
    public function index5(){
        $designation = Designation::orderBy('designation','ASC')->get();
        $title = Title::get();
        $schoolid = Session::get('schoolid');
        $spark_cordinator = SparkCordinator::where('registration_id',$schoolid)->first();
        return view('web.index5',compact('designation','title','spark_cordinator'));
    }
    public function index6(){
        $schoolid = Session::get('schoolid');
        $school_enrolment = Schoolenrolment::where('registration_id',$schoolid)->first();
        $lab_details = LabsDetails::where('registration_id',$schoolid)->get();

        return view('web.index6',compact('school_enrolment','lab_details'));
    }
    public function index7(){
        return view('web.index7');
    }
    public function getDistricts($state_id)
    {
        $districts = District::where('state_id', $state_id)->get();
        return response()->json($districts);
    }
    
    public function getCities($district_id)
    {
        $cities = City::where('districtid', $district_id)->get();
        return response()->json($cities);
    }
    public function thankyou(Request $request){
        $schoolid = $request->registration_id;
        return view('web.thankyou', [
            'schoolUrl' => 'https://schoolportal.example.com',
            'schoolId' => 'SCH123456',
            'tempPassword' => 'Temp@1234'
        ]);
    }


    public function sendOtpMobile(Request $request){
        $otp = rand(100000, 999999);
        $schoolid = Session::get('schoolid');
        if($request->page=='head-of-school-info'){
            $head = Headofschool::where('registration_id',$schoolid)->first();
        }else if($request->page=='spark-cordinator'){
            $head = SparkCordinator::where('registration_id',$schoolid)->first();
        }
        if(!empty($head)){
            $head->mobile           = $request->mobile;
            $head->mobile_otp       = $otp;
            $head->save();
        }else{
            $head = new Headofschool();
            $head->registration_id  = $schoolid;
            $head->mobile       = $request->mobile;
            $head->mobile_otp   = $otp;
            $head->save();
        }
        return response()->json(['status' => 'ok', 'otp' => $otp]);
    }
    public function verifyOtpMobile(Request $request)
    {
        $request->validate([
            'mobile' => 'required|digits:10',
            'otp'    => 'required|digits:6',
        ]);
        $schoolid = Session::get('schoolid');

        if($request->page=='head-of-school-info'){
            $head = Headofschool::where('registration_id', $schoolid)
            ->where('mobile', $request->mobile)
            ->first();
        }else if($request->page=='spark-cordinator'){
            $head = SparkCordinator::where('registration_id', $schoolid)
            ->where('mobile', $request->mobile)
            ->first();
        }
        if ($head && $head->mobile_otp == $request->otp) {
            $head->is_mobile_validate = 1;
            $head->save();
            return response()->json([
                'status'  => 'ok',
                'message' => 'OTP verified successfully.'
            ]);
        }
        return response()->json([
            'status'  => 'fail',
            'message' => 'Invalid OTP or mobile number.'
        ], 422);
    }

    public function sendOtpEmail(Request $request)
    {
        $otp = rand(100000, 999999);
        $schoolid = Session::get('schoolid');
        if($request->page=='head-of-school-info'){
            $head = Headofschool::firstOrNew(['registration_id' => $schoolid]);
        }else if($request->page=='spark-cordinator'){
            $head = SparkCordinator::firstOrNew(['registration_id' => $schoolid]);
        }
        $head->registration_id  = $schoolid;
        $head->email = $request->email;
        $head->email_otp = $otp;
        $head->save();
        // Use Mail::to($head->email)->send() to actually send the email in production
        return response()->json(['status' => 'ok', 'otp' => $otp]); // remove `otp` in production
    }
    public function verifyOtpEmail(Request $request)
    {
        $schoolid = Session::get('schoolid');

        if($request->page=='head-of-school-info'){
            $head = Headofschool::where('registration_id', $schoolid)
            ->where('email', $request->email)
            ->where('email_otp', $request->otp)
            ->first();
        }else if($request->page=='spark-cordinator'){
            $head = SparkCordinator::where('registration_id', $schoolid)
            ->where('email', $request->email)
            ->where('email_otp', $request->otp)
            ->first();
        }
        
        if ($head) {
            $head->is_validate = 1;
            $head->save();
            return response()->json(['status' => 'ok']);
        }
        return response()->json(['status' => 'error']);
    }
}
