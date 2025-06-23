<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Clases;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clases=Clases::get();
        return view('admin.class.view',compact('clases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.class.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:class,name',
        ]);

        Clases::create([
            'name' => $request->name
        ]);

        return redirect()->route('class.create')->with('success', 'Class created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($class)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
         $edit = Clases::find($id);         
        return view('admin.class.edit',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        
         try {
            $edit = Clases::find($id);  
            $edit->name = $request->name; 
            $edit->save();
        return redirect()->route('class.index')->with('success', 'class updated successfully.');
      } catch (\Exception $e) {
                print_r($e->getMessage());
               // return redirect()->back()->with('error', 'An error occurred while registering. Please try again.');
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($class)
    {
        //
    }
}
