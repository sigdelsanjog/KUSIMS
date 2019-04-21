<?php

namespace App\Http\Controllers;

use App\Models\Hostelblock;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Hostel\StoreHostelblocksRequest;
use App\Http\Requests\Hostel\UpdateHostelblocksRequest;

class HostelBlockController  extends Controller
{
    /**
     * Display a listing of Hostelblock.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('hostelblock_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('hostelblock_delete')) {
                return abort(401);
            }
            $hostelblocks = Hostelblock::onlyTrashed()->get();
        } else {
            $hostelblocks = Hostelblock::all();
        }

        return view('hostel.block.index', compact('hostelblocks'));
    }

    /**
     * Show the form for creating new Hostelblock.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('hostelblock_create')) {
            return abort(401);
        }
        return view('hostel.block.create');
    }

    /**
     * Store a newly created Hostelblock in storage.
     *
     * @param  \App\Http\Requests\StoreHostelblocksRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHostelblocksRequest $request)
    {
        if (! Gate::allows('hostelblock_create')) {
            return abort(401);
        }
        $hostelblock = Hostelblock::create($request->all());



        return redirect()->route('hostel.block.index');
    }


    /**
     * Show the form for editing Hostelblock.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('hostelblock_edit')) {
            return abort(401);
        }
        $hostelblock = Hostelblock::findOrFail($id);

        return view('hostel.block.edit', compact('hostelblock'));
    }

    /**
     * Update Hostelblock in storage.
     *
     * @param  \App\Http\Requests\UpdateHostelblocksRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHostelblocksRequest $request, $id)
    {
        if (! Gate::allows('hostelblock_edit')) {
            return abort(401);
        }
        $hostelblock = Hostelblock::findOrFail($id);
        $hostelblock->update($request->all());



        return redirect()->route('hostel.block.index');
    }


    /**
     * Display Hostelblock.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('hostelblock_view')) {
            return abort(401);
        }
        $hostelrooms = \App\Hostelroom::where('block_id', $id)->get();

        $hostelblock = Hostelblock::findOrFail($id);

        return view('hostel.block.show', compact('hostelblock', 'hostelrooms'));
    }


    /**
     * Remove Hostelblock from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('hostelblock_delete')) {
            return abort(401);
        }
        $hostelblock = Hostelblock::findOrFail($id);
        $hostelblock->delete();

        return redirect()->route('hostel.block.index');
    }

    /**
     * Delete all selected Hostelblock at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('hostelblock_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Hostelblock::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Hostelblock from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('hostelblock_delete')) {
            return abort(401);
        }
        $hostelblock = Hostelblock::onlyTrashed()->findOrFail($id);
        $hostelblock->restore();

        return redirect()->route('hostel.block.index');
    }

    /**
     * Permanently delete Hostelblock from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('hostelblock_delete')) {
            return abort(401);
        }
        $hostelblock = Hostelblock::onlyTrashed()->findOrFail($id);
        $hostelblock->forceDelete();

        return redirect()->route('hostel.block.index');
    }
}