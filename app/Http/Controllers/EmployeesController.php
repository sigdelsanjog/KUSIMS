<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Jobtype;
use App\Models\Department;
use App\Models\TeacherCourse;
use App\Imports\MarksImport;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\StoreEmployeesRequest;
use App\Http\Requests\Settings\UpdateEmployeesRequest;

use Maatwebsite\Excel\Facades\Excel;

class EmployeesController extends Controller
{
    /**
     * Display a listing of Employee.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('employee_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('employee_delete')) {
                return abort(401);
            }
            $employees = Employee::onlyTrashed()->get();
        } else {
            $employees = Employee::all();
        }

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating new Employee.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('employee_create')) {
            return abort(401);
        }
        
        $jobs = Jobtype::select('id', 'name')->pluck('name', 'id')
        ->prepend(trans('global.app_please_select'), '')->toArray();


        // $jobs =  Jobtype::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $depts =  Department::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('employees.create', compact('jobs', 'depts'));
    }

    /**
     * Store a newly created Employee in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeesRequest $request)
    {
        if (! Gate::allows('employee_create')) {
            return abort(401);
        }
        $employee = Employee::create($request->all());



        return redirect()->route('setting.employees.index');
    }


    /**
     * Show the form for editing Employee.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('employee_edit')) {
            return abort(401);
        }
        
        $jobs = Jobtype::get()->pluck('name', 'id');
        $deptsComp = Department::get()->pluck('name', 'id');
        $depts = Department::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $batches = \App\Models\Batch::get()->pluck('year', 'id');
        $programs = \App\Models\Program::get()->pluck('name', 'id');
        $courses = \App\Models\Course::get(['code','name','id']);

        $employee = Employee::findOrFail($id);
        
        $teacherCourses = collect();
        if($employee->job_id ==1){
            $teacherCourse = TeacherCourse::where('teacher_id', '=', $id)->get();
            $teacherCourses = $teacherCourse->map(function ($teacherCourse) 
            {
                return [ 
                         'id' => $teacherCourse->id,
                         'program' => $teacherCourse->program()->pluck('name'),
                         'department' => $teacherCourse->department()->pluck('name'),
                         'course' => $teacherCourse->course()->pluck('name'),
                         'batch' => $teacherCourse->batch()->pluck('year'),
                       ];
            })->toArray();
        }


        return view('employees.edit', compact('employee', 'jobs', 'depts','programs','batches','deptsComp','courses','teacherCourses'));
    }

    /**
     * Update Employee in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeesRequest $request, $id)
    {
        if (! Gate::allows('employee_edit')) {
            return abort(401);
        }
        $employee = Employee::findOrFail($id);
        $employee->update($request->all());



        return redirect()->route('setting.employees.index');
    }


    /**
     * Display Employee.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('employee_view')) {
            return abort(401);
        }
        $employee = Employee::findOrFail($id);

        return view('employees.show', compact('employee'));
    }

    public function assignCourse(Request $request)
    { 
        $teacher = TeacherCourse::create($request->all());

        $teacherCourse = TeacherCourse::where('teacher_id', '=', $teacher->teacher_id)->get();
        $teacherCourses = $teacherCourse->map(function ($teacherCourse) 
        {
            return [ 
                     'id' => $teacherCourse->id,
                     'program' => $teacherCourse->program()->pluck('name'),
                     'department' => $teacherCourse->department()->pluck('name'),
                     'course' => $teacherCourse->course()->pluck('name'),
                     'batch' => $teacherCourse->batch()->pluck('year'),
                   ];
        })->toArray();

        return response()->json($teacherCourses);
    }

    /**
     * Remove Employee from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('employee_delete')) {
            return abort(401);
        }
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('setting.employees.index');
    }

    /**
     * Delete all selected Employee at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('employee_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Employee::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Employee from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('employee_delete')) {
            return abort(401);
        }
        $employee = Employee::onlyTrashed()->findOrFail($id);
        $employee->restore();

        return redirect()->route('setting.employees.index');
    }

    /**
     * Permanently delete Employee from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('employee_delete')) {
            return abort(401);
        }
        $employee = Employee::onlyTrashed()->findOrFail($id);
        $employee->forceDelete();

        return redirect()->route('setting.employees.index');
    }
    public function deleteAssignCourse(Request $request)
    { 
        try 
        {
            TeacherCourse::where('id', $request->id)->delete(); // $request->id MUST be an array
            return response()->json('users deleted');
        }
    
        catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
    public function bulkStoreMarks(Request $request)
    {    
        if($request->hasFile('file')){
            $fileData = $request->file('file');
            $export = new MarksImport();
            $export->setParameter($request['course_id']);
          
            Excel::import($export, $request->file('file'));
            
        }
    }
}
