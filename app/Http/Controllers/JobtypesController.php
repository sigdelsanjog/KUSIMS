<?php

namespace App\Http\Controllers;

use App\Models\Jobtype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\StoreJobtypesRequest;
use App\Http\Requests\Settings\UpdateJobtypesRequest;

class JobtypesController extends Controller
{
    /**
     * Display a listing of Jobtype.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('jobtype_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('jobtype_delete')) {
                return abort(401);
            }
            $jobtypes = Jobtype::onlyTrashed()->get();
        } else {
            $jobtypes = Jobtype::all();
        }

        return view('jobtypes.index', compact('jobtypes'));
    }

    /**
     * Show the form for creating new Jobtype.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('jobtype_create')) {
            return abort(401);
        }
        return view('jobtypes.create');
    }

    /**
     * Store a newly created Jobtype in storage.
     *
     * @param  \App\Http\Requests\StoreJobtypesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJobtypesRequest $request)
    {
        if (! Gate::allows('jobtype_create')) {
            return abort(401);
        }
        $jobtype = Jobtype::create($request->all());



        return redirect()->route('setting.jobtypes.index');
    }


    /**
     * Show the form for editing Jobtype.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('jobtype_edit')) {
            return abort(401);
        }
        $jobtype = Jobtype::findOrFail($id);

        return view('jobtypes.edit', compact('jobtype'));
    }

    /**
     * Update Jobtype in storage.
     *
     * @param  \App\Http\Requests\UpdateJobtypesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJobtypesRequest $request, $id)
    {
        if (! Gate::allows('jobtype_edit')) {
            return abort(401);
        }
        $jobtype = Jobtype::findOrFail($id);
        $jobtype->update($request->all());



        return redirect()->route('setting.jobtypes.index');
    }


    /**
     * Display Jobtype.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('jobtype_view')) {
            return abort(401);
        }
        $employees = \App\Employee::where('job_id', $id)->get();

        $jobtype = Jobtype::findOrFail($id);

        return view('jobtypes.show', compact('jobtype', 'employees'));
    }


    /**
     * Remove Jobtype from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('jobtype_delete')) {
            return abort(401);
        }
        $jobtype = Jobtype::findOrFail($id);
        $jobtype->delete();

        return redirect()->route('setting.jobtypes.index');
    }

    /**
     * Delete all selected Jobtype at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('jobtype_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Jobtype::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Jobtype from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('jobtype_delete')) {
            return abort(401);
        }
        $jobtype = Jobtype::onlyTrashed()->findOrFail($id);
        $jobtype->restore();

        return redirect()->route('setting.jobtypes.index');
    }

    /**
     * Permanently delete Jobtype from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('jobtype_delete')) {
            return abort(401);
        }
        $jobtype = Jobtype::onlyTrashed()->findOrFail($id);
        $jobtype->forceDelete();

        return redirect()->route('setting.jobtypes.index');
    }
}
