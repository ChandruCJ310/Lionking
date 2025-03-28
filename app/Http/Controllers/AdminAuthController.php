<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }



    
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Fetch the admin record directly from the database
        $admin = DB::table('admin')->where('email', $request->email)->first();
    
        if ($admin && $admin->password === $request->password) {
            // Manually log in the admin (since we are not using hashing)
            session(['admin_logged_in' => true, 'admin_id' => $admin->id]);
    
            return redirect()->route('admin.dashboard')->with('success', 'Login Successful');
        }
    
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }
    
    
    

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Logged out successfully');
    }
}

