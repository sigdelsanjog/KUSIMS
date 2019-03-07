<?php

namespace App\Http\Controllers;
use App\Models\Department;
use App\Models\School;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    //
    public function index()
    {
        $title = 'Department';
        $departments = Department::all();
        return view('department.index',compact('departments','title'));
    }
    public function create()
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(401);
        // }
        
        $title = 'Create School';

        //$schools = School::pluck('name','id');//;, 'name');

        $schools = School::select('id', 'name')->pluck('name', 'id')
        ->prepend('Select School', '')->toArray();


        return view('department.create',compact('schools'));
    }
    public function edit($id,Request $request)
    {
        // if (Gate::denies('department_view')) {
        //     return abort(401);
        // }

        $title = 'Edit Department';

        if($request->ajax())
        {
            return URL::to('/setting/department/'.$id . '/edit');
        }

        $schools = School::select('id', 'name')->pluck('name', 'id')
        ->prepend('Select School', '')->toArray();

        $department = Department::with(['school'])->findOrFail($id);

        return view('department.edit',compact('title','department','schools'));
    }

    public function store(Request $request)
    {
        // if (Gate::denies('department_create')) {
        //     return abort(401);
        // }

        $department = Department::create($request->all());
        
    
        return redirect()->route('setting.department.index');
    }

    public function update($id,Request $request)
    {
        // if (Gate::denies('department_edit')) {
        //     return abort(401);
        // }

        $department = Department::findOrFail($id);
        $department->update($request->all());
        
        
        

        return redirect()->route('setting.department.index');
    }

    public function destroy($id)
    {
        // if (Gate::denies('department_delete')) {
        //     return abort(401);
        // }

        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('setting.department.index');
    }
}
