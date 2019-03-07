<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\StoreBatchesRequest;
use App\Http\Requests\Settings\UpdateBatchesRequest;

class BatchesController extends Controller
{
    /**
     * Display a listing of Batch.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('batch_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('batch_delete')) {
                return abort(401);
            }
            $batches = Batch::onlyTrashed()->get();
        } else {
            $batches = Batch::all();
        }

        return view('batches.index', compact('batches'));
    }

    /**
     * Show the form for creating new Batch.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('batch_create')) {
            return abort(401);
        }
        return view('batches.create');
    }

    /**
     * Store a newly created Batch in storage.
     *
     * @param  \App\Http\Requests\StoreBatchesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBatchesRequest $request)
    {
        if (! Gate::allows('batch_create')) {
            return abort(401);
        }
        $batch = Batch::create($request->all());



        return redirect()->route('setting.batches.index');
    }


    /**
     * Show the form for editing Batch.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('batch_edit')) {
            return abort(401);
        }
        $batch = Batch::findOrFail($id);

        return view('batches.edit', compact('batch'));
    }

    /**
     * Update Batch in storage.
     *
     * @param  \App\Http\Requests\UpdateBatchesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBatchesRequest $request, $id)
    {
        if (! Gate::allows('batch_edit')) {
            return abort(401);
        }
        $batch = Batch::findOrFail($id);
        $batch->update($request->all());



        return redirect()->route('setting.batches.index');
    }


    /**
     * Display Batch.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('batch_view')) {
            return abort(401);
        }
        $batch = Batch::findOrFail($id);

        return view('batches.show', compact('batch'));
    }


    /**
     * Remove Batch from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('batch_delete')) {
            return abort(401);
        }
        $batch = Batch::findOrFail($id);
        $batch->delete();

        return redirect()->route('setting.batches.index');
    }

    /**
     * Delete all selected Batch at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('batch_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Batch::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Batch from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('batch_delete')) {
            return abort(401);
        }
        $batch = Batch::onlyTrashed()->findOrFail($id);
        $batch->restore();

        return redirect()->route('setting.batches.index');
    }

    /**
     * Permanently delete Batch from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('batch_delete')) {
            return abort(401);
        }
        $batch = Batch::onlyTrashed()->findOrFail($id);
        $batch->forceDelete();

        return redirect()->route('batches.index');
    }
}