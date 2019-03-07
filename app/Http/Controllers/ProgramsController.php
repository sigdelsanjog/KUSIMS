<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\StoreProgramsRequest;
use App\Http\Requests\Settings\UpdateProgramsRequest;

class ProgramsController extends Controller
{
    /**
     * Display a listing of Program.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('program_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('program_delete')) {
                return abort(401);
            }
            $programs = Program::onlyTrashed()->get();
        } else {
            $programs = Program::all();
        }

        return view('programs.index', compact('programs'));
    }

    /**
     * Show the form for creating new Program.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('program_create')) {
            return abort(401);
        }
        return view('programs.create');
    }

    /**
     * Store a newly created Program in storage.
     *
     * @param  \App\Http\Requests\StoreProgramsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProgramsRequest $request)
    {
        if (! Gate::allows('program_create')) {
            return abort(401);
        }
        $program = Program::create($request->all());



        return redirect()->route('setting.programs.index');
    }


    /**
     * Show the form for editing Program.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('program_edit')) {
            return abort(401);
        }
        $program = Program::findOrFail($id);

        return view('programs.edit', compact('program'));
    }

    /**
     * Update Program in storage.
     *
     * @param  \App\Http\Requests\UpdateProgramsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProgramsRequest $request, $id)
    {
        if (! Gate::allows('program_edit')) {
            return abort(401);
        }
        $program = Program::findOrFail($id);
        $program->update($request->all());



        return redirect()->route('setting.programs.index');
    }


    /**
     * Display Program.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('program_view')) {
            return abort(401);
        }
        $program = Program::findOrFail($id);

        return view('programs.show', compact('program'));
    }


    /**
     * Remove Program from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('program_delete')) {
            return abort(401);
        }
        $program = Program::findOrFail($id);
        $program->delete();

        return redirect()->route('setting.programs.index');
    }

    /**
     * Delete all selected Program at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('program_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Program::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Program from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('program_delete')) {
            return abort(401);
        }
        $program = Program::onlyTrashed()->findOrFail($id);
        $program->restore();

        return redirect()->route('setting.programs.index');
    }

    /**
     * Permanently delete Program from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('program_delete')) {
            return abort(401);
        }
        $program = Program::onlyTrashed()->findOrFail($id);
        $program->forceDelete();

        return redirect()->route('setting.programs.index');
    }
}