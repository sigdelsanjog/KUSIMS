<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use Auth;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Feedback;
use Spatie\Permission\Models\Role;

class FeedbackController extends Controller
{
    public function show(){

        $id = Auth::user()->employee->id;

        if(Auth::user()->user_type=="Employee")
    	    //$recieves = Feedback::all()->where('teacher_id',$id)->pluck('message','teacher_id','student_id');
            $recieves = Feedback::all()->where('teacher_id', $id);
        elseif(Auth::user()->user_type=="Student")
    		//$recieves = Feedback::all()->where('student_id',Auth::id())->pluck('message','teacher_id','student_id');
            $recieves = Feedback::all()->where('student_id',Auth::id());
        else
            //$recieves = Feedback::all()->where('teacher_id', $id)->pluck('message','teacher_id','student_id');
            $recieves = Feedback::all()->where('teacher_id', $id);
            
    	return view('feedbacks.show',compact('recieves'));
    }
    

    public function create(){

    	$employees = Employee::all();
    	
    	$employees = $employees->mapWithKeys(function ($item){
    		return [$item['id'] => $item['first_name']." ".$item['last_name']];
    	});
    	
    	return view('feedbacks.create',compact('employees'));
        //return redirect()->route('feedbacks.create')->with('message','Feedback sent!');

    }

    public function savemsg(Request $request){
    	$feedbacks = new \App\Feedback();
        $feedbacks->message = $request['feedback'];
        $feedbacks->teacher_id = $request['employee'];
        $feedbacks->student_id = Auth::id();

        $feedbacks->save();
        
        $employees = Employee::all();
    	
    	$employees = $employees->mapWithKeys(function ($item){
    		return [$item['id'] => $item['first_name']." ".$item['last_name']];
    	});
    	
    	//return view('feedbacks.create',compact('employees'));
        return redirect()->route('feedbacks.create')->with('message','Feedback sent!');
    }
}