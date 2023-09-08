<?php

namespace App\Http\Controllers;
use App\Models\User;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user(); // Use the user() method to get the authenticated user
            $userRole = $user->UserRole; // Note: Using camelCase

            if ($userRole == 'user') {
                return view('dashboard.dashboard');
            } elseif ($userRole == 'admin') {
                return view('admin.adminhome');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }
    }
}
