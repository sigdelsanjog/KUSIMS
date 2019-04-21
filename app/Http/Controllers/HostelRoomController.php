<?php

namespace App\Http\Controllers;

use App\Models\Hostelroom;
use App\Models\Hostelblock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Hostel\StoreHostelroomsRequest;
use App\Http\Requests\Hostel\UpdateHostelroomsRequest;

class HostelRoomController extends Controller
{
    /**
     * Display a listing of Hostelroom.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('hostelroom_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('hostelroom_delete')) {
                return abort(401);
            }
            $hostelrooms = Hostelroom::onlyTrashed()->get();
        } else {
            $hostelrooms = Hostelroom::all();
        }

        return view('hostel.room.index', compact('hostelrooms'));
    }

    /**
     * Show the form for creating new Hostelroom.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('hostelroom_create')) {
            return abort(401);
        }
        
        $blocks = Hostelblock::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('hostel.room.create', compact('blocks'));
    }

    /**
     * Store a newly created Hostelroom in storage.
     *
     * @param  \App\Http\Requests\StoreHostelroomsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHostelroomsRequest $request)
    {
        if (! Gate::allows('hostelroom_create')) {
            return abort(401);
        }
        $hostelroom = Hostelroom::create($request->all());



        return redirect()->route('hostel.room.index');
    }


    /**
     * Show the form for editing Hostelroom.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('hostelroom_edit')) {
            return abort(401);
        }
        
        $blocks = Hostelblock::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $hostelroom = Hostelroom::findOrFail($id);

        return view('hostel.room.edit', compact('hostelroom', 'blocks'));
    }

    /**
     * Update Hostelroom in storage.
     *
     * @param  \App\Http\Requests\UpdateHostelroomsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHostelroomsRequest $request, $id)
    {
        if (! Gate::allows('hostelroom_edit')) {
            return abort(401);
        }
        $hostelroom = Hostelroom::findOrFail($id);
        $hostelroom->update($request->all());



        return redirect()->route('hostel.room.index');
    }


    /**
     * Display Hostelroom.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('hostelroom_view')) {
            return abort(401);
        }
        $hostelroom = Hostelroom::findOrFail($id);

        return view('hostel.room.show', compact('hostelroom'));
    }


    /**
     * Remove Hostelroom from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('hostelroom_delete')) {
            return abort(401);
        }
        $hostelroom = Hostelroom::findOrFail($id);
        $hostelroom->delete();

        return redirect()->route('hostel.room.index');
    }

    /**
     * Delete all selected Hostelroom at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('hostelroom_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Hostelroom::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Hostelroom from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('hostelroom_delete')) {
            return abort(401);
        }
        $hostelroom = Hostelroom::onlyTrashed()->findOrFail($id);
        $hostelroom->restore();

        return redirect()->route('hostel.room.index');
    }

    /**
     * Permanently delete Hostelroom from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('hostelroom_delete')) {
            return abort(401);
        }
        $hostelroom = Hostelroom::onlyTrashed()->findOrFail($id);
        $hostelroom->forceDelete();

        return redirect()->route('hostel.room.index');
    }
}