<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\SchoolLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SchoolLoignController extends Controller
{
    public function  index(){
        return view('school.auth-signin');
    }

    public function store(SchoolLoginRequest $request): RedirectResponse
    {
        try {
            $request->authenticate();
            $request->session()->regenerate();
    
            return redirect()->intended(route('school.dashboard', absolute: false));
        } catch (ValidationException $e) {
            // Optional: You can customize error handling, e.g., adding a general error message
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }
    

    public function destroy(Request $request): RedirectResponse
    {
        
        Auth::guard('school')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('school-login');
    }
    
}
