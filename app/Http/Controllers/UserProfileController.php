<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\TeacherCourse;

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

    public function getCourses($id)
    {
        $teacherCourse = TeacherCourse::where('teacher_id', '=', $id)->get();
        $teacherCourses = $teacherCourse->map(function ($teacherCourse) 
        {
            return [ 
                     'id' => $teacherCourse->id,
                     'program' => $teacherCourse->program()->pluck('name'),
                     'department' => $teacherCourse->department()->pluck('name'),
                     'course' => $teacherCourse->course()->pluck('name'),
                     'course_id' => $teacherCourse->course()->pluck('id')->first(),
                     'batch' => $teacherCourse->batch()->pluck('year'),
                   ];
        })->toArray();

        return response()->json($teacherCourses);
    }
    
    //
}
