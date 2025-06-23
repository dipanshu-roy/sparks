<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolRegistration;
use App\Models\Headofschool;
use App\Models\Schoolenrolment;
use App\Models\SchoolDetails;
use App\Models\SparkCordinator;
use App\Models\Genrateurl;

use Illuminate\Support\Facades\DB;


class ManageSchoolController extends Controller
{

    public function index(){ 
         $data = DB::table('school_registration as a')
        ->leftJoin('school_details as b', 'a.id', '=', 'b.registration_id')
        ->leftJoin('head_of_school as c', 'a.id', '=', 'c.registration_id')
        ->leftJoin('spark_coordinator as d', 'a.id', '=', 'd.registration_id')
        ->leftJoin('enrollment_details as e', 'a.id', '=', 'e.registration_id')
        ->leftJoin('generate_url as f', 'a.id', '=', 'f.registration_id')
        ->select(
        'a.id',
        'a.updated_at',
        'a.gmail as email',
        'a.mobileno',
        'b.registration_id as bregistration_id',
        'c.registration_id as cregistration_id',
        'd.registration_id as dregistration_id',
        'e.registration_id as eregistration_id',
        'f.registration_id as fregistration_id'
        )->orderBy('a.id','DESC')->groupBy('a.id','DESC')->get();

        return view('admin.manage_school.view',compact('data'));
    }

    public function view($id){
         $data = DB::table('school_registration as a')
        ->leftJoin('school_details as b', 'a.id', '=', 'b.registration_id')
        ->leftJoin('head_of_school as c', 'a.id', '=', 'c.registration_id')
        ->leftJoin('spark_coordinator as d', 'a.id', '=', 'd.registration_id')
        ->leftJoin('enrollment_details as e', 'a.id', '=', 'e.registration_id')
        ->leftJoin('generate_url as f', 'a.id', '=', 'f.registration_id')
        ->leftJoin('state as g', 'g.state_id', '=', 'b.state_id')
        ->leftJoin('district as h', 'h.districtid', '=', 'b.district_id')
        ->leftJoin('city as i', 'i.id', '=', 'b.city_id')
        ->leftJoin('board as j', 'j.id', '=', 'b.board_id')
        ->leftJoin('designation as k', 'k.id', '=', 'c.designation')
        ->leftJoin('sp_title as l', 'l.id', '=', 'c.title_id')
        ->leftJoin('designation as m', 'm.id', '=', 'd.designation')
        ->leftJoin('sp_title as n', 'n.id', '=', 'd.title_id')
        ->select(
        'a.id','a.updated_at','a.gmail as email','a.mobileno',
        'b.school_name', 'h.district_title as school_distric', 'i.name as school_city', 'j.board as school_board','g.state_title as school_state',
        'l.title as head_title', 'c.first_name', 'c.last_name', 'c.second_name', 'c.email', 'c.mobile', 'k.designation as head_designation',
        'n.title as coordinator_title', 'd.first_name as cfirst_name', 'd.second_name as csecond_name', 'd.last_name as clast_name', 'd.mobile as cmobile', 'd.email as cemail', 'm.designation as coordinator_designation',
        'e.total_enrollment', 'e.class_1_to_8_enroll', 'e.total_com_labs',
        'f.school_url'       
        )->where('a.id',$id)->first();
        return view('admin.manage_school.views',compact('data'));
    }
}
