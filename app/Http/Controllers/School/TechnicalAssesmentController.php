<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schoolenrolment;
use App\Models\labsDetails;
use Illuminate\Support\Facades\Auth;
class TechnicalAssesmentController extends Controller
{
    public function index(){
        $user = Auth::guard('school')->user();
        $enrollment_details   = Schoolenrolment::where('registration_id',$user->id)->first();
        $labs=labsDetails::where('registration_id',$user->id)->get();
        return view('school.technicalassesment',compact('enrollment_details','labs'));
    }
}
