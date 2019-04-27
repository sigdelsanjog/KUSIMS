<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Notice;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $now = date('Y-m-d');

        if(Auth::user()->user_type == 'Administrator'){
            $notices = Notice::all();
        }
        else if(Auth::user()->user_type == 'Employee'){
            
            $notices = Notice::where('user_type', '=', Auth::user()->user_type)->get();
        }
        else{
            $notices = Notice::where('user_type', '=', 'Student')->get();
        }
        $notices = $notices->load('created_by');

        $fields = '{
            "created_by": { "key": "created_by.name","label": "Recent updates", "sortable": true },
            
            }';        
        return view('home', compact('notices','fields'));
    }
}
