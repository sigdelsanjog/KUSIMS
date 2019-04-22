<?php

namespace App\Http\Controllers;
use App\Models\HostelBook;
use App\Models\Hostelblock;
use App\Models\Hostelroom;
use Auth;

use Illuminate\Http\Request;
class HostelBookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // if (! Gate::allows('hostelbook_access')) {
        //     return abort(401);
        // }


        if (request('show_deleted') == 1) {
            // if (! Gate::allows('hostelbook_delete')) {
            //     return abort(401);
            // }
            $hostelBookDetails = HostelBook::onlyTrashed()->get();
        } else {
            $hostelBookDetails = HostelBook::all();
        }
       
        return view('hostel.student.index', compact('hostelBookDetails'));
    }
    public function create()
    {
       
        return redirect()->route('hostel.book.index');
    }
    public function store(Request $request)
    {

        $hostelBooks = HostelBook::where('student_id', '=', Auth::user()->student->id)->first();

        if(is_null($hostelBooks)){
            
            $hostelBook = new HostelBook();
            $hostelBook->student_id = Auth::user()->student->id;
            $hostelBook->status = "1";
    
            $hostelBook->save();
            
            return redirect()->back()->with('message', 'Hostel Applied Successfully!');
        }
        return redirect()->back()->with('message', 'Hostel Applied Already!');
    }
    public function show($id)
    {
        // if (! Gate::allows('hostelroom_view')) {
        //     return abort(401);
        // }

        $hostelblock = HostelBook::findOrFail($id);

        return view('hostel.student.view', compact('hostelblock'));
    }    
    public function pullHostelBlock()
    {

        $hostelblock =  Hostelblock::all();//->get();
        return response()->json($hostelblock);
    }
    public function pullHostelRoom()
    {

        $hostelroom =  Hostelroom::all();//->get();
        return response()->json($hostelroom);
    }
    public function postHostelStatus(Request $request){
        HostelBook::updateOrCreate(
            ['id' => $request->id], 
            [
                'room_id' => $request->room_id,
                'status' => $request->status,
                'remarks' => $request->remarks,
            ]);
    }
}