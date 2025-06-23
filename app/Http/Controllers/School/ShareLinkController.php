<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Genrateurl;
use App\Models\GenrateLink;
use App\Models\ExamShedule;
class ShareLinkController extends Controller
{
    public function index(){
    $user = Auth::guard('school')->user();
    $url = Genrateurl::where('registration_id',$user->id)->first();
    $exam_shedule = ExamShedule::where('status',0)->get();
    $links_list = GenrateLink::where('school_id',$user->id)->where('status',0)->first();    
        return view('school.sharelink',compact('url','exam_shedule','links_list'));
    }


    public function store(Request $request){
        //return $request;
        $user = Auth::guard('school')->user();

        // Try to find an existing link for this school and date
          $existingLink = GenrateLink::where('school_id', $user->id)
            ->where('id', $request->id) 
            ->where('status',0)->first();
        
        if ($existingLink) { 

            $existingLink->link = $request->link;
            $existingLink->date_id = $request->date_id;
            $existingLink->save();

            return redirect()->back()->with('success', "Link  Updated Successfully");
        } else {
            // Create new record
            $newLink = new GenrateLink();
            $newLink->school_id = $user->id;
            $newLink->date_id = $request->date_id;
            $newLink->link = $request->link;
            $newLink->save();
            return redirect()->back()->with('success', "Link Created Successfully");
        }
        
       
    }



}
