<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Headofschool;
use App\Models\SchoolDetails;
use App\Models\Genrateurl;
use App\Models\GenrateLink;
use App\Models\ExamShedule;
class DashboardController extends Controller
{
    public function dashboard(){

      $user = Auth::guard('school')->user();
      $hs = Headofschool::where('registration_id',$user->id)->first();  
      $hs1 = SchoolDetails::where('registration_id',$user->id)->first();  

      $url = Genrateurl::where('registration_id',$user->id)->first();
      $exam_shedule = ExamShedule::where('status',0)->get();
      $links_list = GenrateLink::where('school_id',$user->id)->where('status',0)->first();    
           
      return view('school.dashboard',compact('hs','hs1','url','exam_shedule','links_list','user'));
    }
}
