<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{    
    
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->user_type == "Student")
            return view('profile.student');

        return view('profile.employee');
    }
    //
}
