<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\SchoolDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SchoolDetailsController extends Controller
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
    public function store(Request $request)
    {
        $request->validate([
            'board_id'    => 'required|integer',
            'school_name' => 'required|string|max:255',
            'state_id'    => 'required|integer',
            'district_id' => 'required|integer',
            'city_id'     => 'required',
            'pin'         => 'required|integer',
        ]);
        $data = $request->all();
        $school = SchoolDetails::where('registration_id', $request->registration_id)->first();
        if ($school) {
            $school->update($data);
            $message = 'School information updated successfully.';
        } else {
            SchoolDetails::create($data);
            $message = 'School information saved successfully.';
        }
        return redirect(route('head.of.school'))->with('success', $message);
    }


    /**
     * Display the specified resource.
     */
    public function show(SchoolDetails $schoolDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolDetails $schoolDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SchoolDetails $schoolDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolDetails $schoolDetails)
    {
        //
    }

    public function autocomplete(Request $request)
    {
        $query = $request->get('query');

        $schools = DB::table('school_details')
        ->where('school_name', 'LIKE', "%{$query}%")
        ->groupBy('school_name')
        ->get();
        $output = '';
        if ($schools->count()) {
            foreach ($schools as $school) {
                $output .= '<a href="#" class="list-group-item list-group-item-action school-suggestion">' . $school->school_name . '</a>';
            }
        } else {
            $output = '';
        }
        return response($output);
    }

}
