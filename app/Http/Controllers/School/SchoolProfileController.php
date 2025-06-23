<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Board;
use App\Models\State;
use App\Models\District;
use App\Models\City;
use App\Models\Designation;
use App\Models\Title;
use App\Models\SparkCordinator;
use App\Models\Headofschool;
use App\Models\SchoolDetails;
use App\Models\Schoolenrolment;
use App\Models\LabsDetails;
use Illuminate\Support\Str;
class SchoolProfileController extends Controller
{
    public function index(){  
        $user   = Auth::guard('school')->user();
        $boards = Board::get();
        $states = State::get();        
        $title  = Title::get();
        $designation = Designation::orderBy('designation','ASC')->get();
        $sd = SchoolDetails::where('registration_id',$user->id)->first();        
        $sp = SparkCordinator::where('registration_id',$user->id)->first();        
        $hs = Headofschool::where('registration_id',$user->id)->first();        
        $se = Schoolenrolment::where('registration_id',$user->id)->first();        
        $ld = LabsDetails::where('registration_id',$user->id)->get();        
        $district = District::where('state_id',$sd->state_id)->get();        
        return view('school.profile',compact('states','boards','sd','sp','hs','district','title','designation','se','ld','user'));
    }


    public function upload_image(Request $request)
    {
        try {
            $user   = Auth::guard('school')->user();
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
    
        $image = $request->file('image');
    
        // Optional: Create a unique filename
        $filename = $user->school_id.'_'.time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
    
        // Move to public/images directory
        $image->move(public_path('school_logo'), $filename);
        $user->image = 'school_logo/' . $filename;
        $user->save();

        return back()->with('success', 'Image uploaded successfully.')
                     ->with('path', 'images/' . $filename);
                      } catch (\Exception $e) {
                // print_r($e->getMessage());
                return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
