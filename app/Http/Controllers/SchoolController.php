<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use Illuminate\Support\Facades\DB;

class SchoolController extends Controller
{
    //
    public function index()
    {
        $title = 'School Info';
        // $schoolList = School::all();
        //$schoolList =  DB::table('school')
        

        $schoolList = School::all();
        
        # Add fake column you want by this command

        return view('school.index',compact('schoolList','title'));
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create School';

        return view('school.create');
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $school = new School();


        $school->name = $request->name;
        $school->address = $request->address;
        $school->phone = $request->phone;
        $school->email = $request->email;
        $school->contact_person = $request->contact_person;
        $school->contact_person_phone = $request->contact_person_phone;
        $school->status = $request->status;
        $school->notes = $request->notes;

        $school->save();

       // $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        //$pusher->trigger('test-channel',
          //               'test-event',
            //            ['message' => 'A new schoolinfo has been created !!']);

            return redirect()->route('setting.school.index');
    }
    /**
     * Display the specified resource.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $title = 'Show Schoolinfo';

        if($request->ajax())
        {
            return URL::to('/setting/school/'.$id);
        }

        $schoolinfo = School::findOrfail($id);
        return view('setting.school.show',compact('title','school'));
    }
    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit School';
        if($request->ajax())
        {
            return URL::to('/setting/school/'. $id . '/edit');
        }
        $school = School::findOrfail($id);
        return view('school.edit',compact('title','school'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $school = School::findOrfail($id);

        $school->name = $request->name;
        $school->address = $request->address;
        $school->phone = $request->phone;
        $school->email = $request->email;
        $school->contact_person = $request->contact_person;
        $school->contact_person_phone = $request->contact_person_phone;
        $school->status = $request->status;
        $school->notes = $request->notes;


        $school->save();

        return redirect()->route('setting.school.index');
    }

    /**
     * Delete confirmation message by Ajaxis.
     *
     * @link      https://github.com/amranidev/ajaxis
     * @param    \Illuminate\Http\Request  $request
     * @return  String
     */
    public function DeleteMsg($id,Request $request)
    {
        // $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/schoolinfo/'. $id . '/delete');

        if($request->ajax())
        {
            return $msg;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     	$school = School::findOrfail($id);
     	$school->delete();
        return URL::to('school');
    }
}
