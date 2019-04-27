<?php

namespace App\Http\Controllers;

use App\Mode\BusAdmin;
use App\Models\BusRoute;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;

class BusController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //
	public function index(){
		return view('bus.index');
	}

	public function busApply(){
        $deparmentList = Department::all();
	    return view('bus.busApply')->with('deparmentList',$deparmentList);
    }

    public function busNotice(){
        return view('bus.busNotice');
    }

       public function storeBusApply(Request $request){
        $firstname = $request->input('firstname');
        $middlename = $request->input('middlename');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $phoneno = $request->input('phoneno');
        $batch = $request->input('batch');
        $regno = $request->input('regno');
        $department = $request->input('department');
        $busStop = $request->input('busStop');

        $newBusAdmin = new BusAdmin();
        $newBusAdmin->first_name = $firstname;
        $newBusAdmin->middle_name = $middlename;
        $newBusAdmin->last_name = $lastname;
        $newBusAdmin->phone  = $phoneno;
        $newBusAdmin->email =$email;
        $newBusAdmin->reg_no = $batch;
        $newBusAdmin->dept_id = $regno;
        $newBusAdmin->batch_id = $department;
        $newBusAdmin->bus_stop = $busStop;
        $newBusAdmin->user_id = Auth::user()->id;
        $newBusAdmin->status = 0;
        $newBusAdmin->save();

        return ("bus root successfully Apply!!");
    }

    public function busAdmin(){
        $BusApplyListStatus1 = BusAdmin::where('status','<>',1)->get();
        $Route = BusRoute::all();
        $BusApplyListStatus0 = BusAdmin::where('status','<>',0)->get();
        return view("bus.busAdmin")->with('BusApplyListStatus1',$BusApplyListStatus1)->with('Route',$Route)->with('BusApplyListStatus0',$BusApplyListStatus0);
    }



    public function approveRoute(Request $request){
        $bid = $request->input('bid');
        $route = $request->input('busroute');

        $updateBus = BusAdmin::find($bid);
        $updateBus->route = $route;
        $updateBus->status = 1;
        $updateBus->save();
        return redirect()->back();

    }

    public function addRoute(Request $request){
        $newRoute = new BusRoute();
        $newRoute->route_name=$request->input('route');
        $newRoute->station=$request->input('station');
        $newRoute->bus_no=$request->input('busno');
        $newRoute->save();

        return redirect()->back();
    }
}
