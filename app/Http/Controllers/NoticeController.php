<?php

namespace App\Http\Controllers;

use App\Models\Notice;

use App\User;

use Auth;
use Carbon\Carbon;
use DateTime;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class NoticeController extends Controller
{
    /**
     * Display a listing of notice.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('notice_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('notice_delete')) {
                return abort(401);
            }
            $notices = Notice::onlyTrashed()->get();
        } else {
            $notices = Notice::all();
        }

        return view('notice.index', compact('notices'));
    }

    /**
     * Show the form for creating new notice.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (! Gate::allows('notice_create')) {
        //     return abort(401);
        // }
        $enum_user_type = User::$enum_user_type;

        return view('notice.create', compact('enum_user_type'));
    }

    /**
     * Store a newly created notice in storage.
     *
     * @param  \App\Http\Requests\StoreJobtypesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (! Gate::allows('notice_create')) {
            return abort(401);
        }
        $request->validate([
            'title'=>'required',
            'description'=> 'required',
            'user_type' => 'required',
            'from_date' =>'required|date',
            'to_date' =>'required|date'
          ]);

        $notice = new Notice([
            'user_id' => Auth::user()->id,
            'title'=> $request->post('title'),
            'description'=> $request->post('description'),
            'user_type'=> $request->post('user_type'),
            'from_date'=>$request->post('from_date'),
            'to_date'=> $request->post('to_date')
         ]);
        
        $notice->save();

        return redirect()->route('notice.index');
    }


    /**
     * Show the form for editing notice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('notice_edit')) {
            return abort(401);
        }

        $notice = Notice::findOrFail($id);
       
        $enum_user_type = User::$enum_user_type;
        return view('notice.edit', compact('notice','enum_user_type'));
    }

    /**
     * Update notice in storage.
     *
     * @param  \App\Http\Requests\UpdateJobtypesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (! Gate::allows('notice_edit')) {
            return abort(401);
        }

        $request->validate([
            'title'=>'required',
            'description'=> 'required',
            'user_type' => 'required',
            'from_date' =>'required|date',
            'to_date' =>'required|date'
          ]);
    
       
         
            $notice = Notice::findOrFail($id);
            $notice->user_id = Auth::user()->id;
            $notice->title = $request->title;
            $notice->description = $request->description;
            $notice->user_type = $request->user_type;
            $notice->from_date = $request->from_date;
            $notice->to_date = $request->to_date;

            $notice->save();


            return redirect()->route('notice.index')->with('success', 'Notice has been updated');
    }


    /**
     * Display notice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('notice_view')) {
            return abort(401);
        }
       

        $notice = Notice::findOrFail($id);

        return view('notice.show', compact('notice'));
    }


    /**
     * Remove notice from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('notice_delete')) {
            return abort(401);
        }
        $notice = Notice::findOrFail($id);
        $notice->delete();

        return redirect()->route('setting.notice.index');
    }

    /**
     * Delete all selected notice at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('notice_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Notice::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore notice from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('notice_delete')) {
            return abort(401);
        }
        $notice = notice::onlyTrashed()->findOrFail($id);
        $notice->restore();

        return redirect()->route('setting.notice.index');
    }

    /**
     * Permanently delete notice from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('notice_delete')) {
            return abort(401);
        }
        $notice = notice::onlyTrashed()->findOrFail($id);
        $notice->forceDelete();

        return redirect()->route('setting.notice.index');
    }
}
