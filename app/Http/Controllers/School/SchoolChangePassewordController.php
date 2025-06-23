<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SchoolChangePassewordController extends Controller
{
            public function update_password_after_login(Request $request)
            {
                try {                                                                    
                $request->validate([
                    'password' => 'required|string|confirmed|min:8',
                ]);

                 $user = Auth::guard('school')->user();
                    $user->password = Hash::make($request->password);
                    $user->fist_chanege_pass = true;
                    $user->save();

                    return redirect()->back()->with('success', 'Password updated successfully!');
                }
            catch (\Exception $e) {
                            // print_r($e->getMessage());
                            return redirect()->back()->with('error', $e->getMessage());
                }
        }
}
