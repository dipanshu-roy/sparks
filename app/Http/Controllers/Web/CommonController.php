<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\State;
use App\Models\District;
use App\Models\Otp;
use App\Models\City;
use App\Models\Designation;
use App\Models\Title;
use App\Models\SchoolDetails;
use App\Models\Headofschool;
use App\Models\SparkCordinator;
use App\Models\Schoolenrolment;
use App\Models\LabsDetails;
use App\Models\Subject;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class CommonController extends Controller
{
    public function index1(){
        return view('web.home');
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

        }else if($request->page=='spark-cordinator'){
            $head = SparkCordinator::where('registration_id',$schoolid)->first();
            if(!empty($head)){
                $head->mobile           = $request->mobile;
                $head->mobile_otp       = $otp;
                $head->save();
            }else{
                $head = new SparkCordinator();
                $head->registration_id  = $schoolid;
                $head->mobile       = $request->mobile;
                $head->mobile_otp   = $otp;
                $head->save();
            }
        }
        return response()->json(['status' => 'ok', 'otp' => 'Sent']);
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
            $head = Headofschool::where('registration_id',$schoolid)->first();
            if(!empty($head)){
                $head->email            = $request->email;
                $head->email_otp        = $otp;
                $head->save();
            }else{
                $head = new Headofschool();
                $head->registration_id  = $schoolid;
                $head->email            = $request->email;
                $head->email_otp        = $otp;
                $head->save();
            }
        }else if($request->page=='spark-cordinator'){
            $head = SparkCordinator::where('registration_id',$schoolid)->first();
            if(!empty($head)){
                $head->email            = $request->email;
                $head->email_otp        = $otp;
                $head->save();
            }else{
                $head = new SparkCordinator();
                $head->registration_id  = $schoolid;
                $head->email            = $request->email;
                $head->email_otp        = $otp;
                $head->save();
            }
        }
        try {
            $data = ['otp' => $otp];
            $subject = "One-Time Password for Spark Olympiads";
            $value = $head->email;
            Mail::send('email_template.otp', $data, function ($message) use ($value, $subject) {
                $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME', 'NoReply'));
                $message->to($value);
                $message->subject($subject);
            });
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to send OTP email.',
                'message' => $e->getMessage()
            ], 500);
        }
        return response()->json(['status' => 'ok', 'otp' => 'Sent']);
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
    public function Getsubject($state_id)
    {
        return $subjects = Subject::whereRaw("FIND_IN_SET(?, class_id)", [$state_id])->get();
         return response()->json($subjects);
    }
    public function resend(Request $request)
    {
        $request->validate([
            'validate_details' => 'required'
        ]);

        $value = $request->validate_details;
        if (preg_match('/^[0-9]{10}$/', $value)) {
            $type = 'mobile';
        } elseif (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $type = 'email';
        } else {
            return response()->json(['error' => 'Invalid mobile or email.'], 422);
        }
        $otp = rand(100000, 999999);
        if($type=='mobile'){

        }else{
            try {
                $data = ['otp' => $otp];
                $subject = "One-Time Password for Spark Olympiads";
                Mail::send('email_template.otp', $data, function ($message) use ($value, $subject) {
                    $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME', 'NoReply'));
                    $message->to($value);
                    $message->subject($subject);
                });
            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'Failed to send OTP email.',
                    'message' => $e->getMessage()
                ], 500);
            }
        }

        $existing = Otp::where('source', $value)->latest()->first();

        if ($existing) {
            $existing->otp = $otp;
            $existing->status = 0;
            $existing->validate = 0;
            $existing->save();
        } else {
            $newOtp = new Otp();
            $newOtp->registration_id = 0; // or use actual ID if known
            $newOtp->otp             = $otp;
            $newOtp->status          = 0;
            $newOtp->validate        = 0;
            $newOtp->source          = $value;
            $newOtp->type            = $type;
            $newOtp->save();
        }
        // TODO: Send OTP via email or SMS based on $type

        return response()->json(['status'=>200,'message' => 'OTP resent successfully']);
    }
    public function CheckVerifiedData(Request $request){
        $schoolid = Session::get('schoolid');
        if($request->page == 'cordinator'){
            $head_of_school = SparkCordinator::select('is_mobile_validate','is_validate')->where('registration_id', $schoolid)->first();
        }else{
            $head_of_school = Headofschool::select('is_mobile_validate','is_validate')->where('registration_id', $schoolid)->first();
        }
        if(!empty($head_of_school)){
            if($head_of_school->is_mobile_validate==0 && $head_of_school->is_validate==0){
                $title = "Mobile Number and Email Not Verified";
                $decription = "Do you want to proceed without verifying your mobile number and email address?";
            }elseif($head_of_school->is_validate==0){
                $title = "Email Not Verified";
                $decription = "Do you want to proceed without verifying your email address?";
            }elseif($head_of_school->is_mobile_validate==0){
                $title = "Mobile Number Not Verified";
                $decription = "Do you want to proceed without verifying your mobile number?";
            }else{
                return response()->json(['status'=>200]);
            }
        }else{
            $title = "Mobile Number and Email Not Verified";
            $decription = "Do you want to proceed without verifying your mobile number and email address?";
        }
        return response()->json(['status'=>400,'title' => $title,'decription'=>$decription]);
    }
    public function computer_requirement(){
        return view('school.computer-lab-readiness.index');
    }
    public function computer_requirement1(){
        return view('school.computer-lab-readiness.index2');
    }
    public function preview(Request $request)
    {
        $boards = Board::get();
        $states = State::get();
        $schoolid = Session::get('schoolid');
        $school = SchoolDetails::select('school_details.*', 'districts.name as district_name')
        ->leftJoin('districts', 'school_details.district_id', '=', 'districts.districtid')
        ->where('school_details.registration_id', $schoolid)
        ->first();


        $designation = Designation::orderBy('designation','ASC')->get();
        $title = Title::get();
        $head_of_school = Headofschool::where('registration_id',$schoolid)->first();

        $spark_cordinator = SparkCordinator::where('registration_id',$schoolid)->first();

        $school_enrolment = Schoolenrolment::where('registration_id',$schoolid)->first();
        $lab_details = LabsDetails::where('registration_id',$schoolid)->get();


        return view('web.preview-table', compact('data'));
    }
}
