<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Department;
use App\Models\StudentDocument;
use App\Models\StudentAddress;
use App\Models\StudentQualification;
use App\Models\Marks;


use App\Imports\StudentImport;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Manage\StoreStudentsRequest;
use App\Http\Requests\Manage\UpdateStudentsRequest;
use Maatwebsite\Excel\Facades\Excel;

class StudentsController extends Controller
{
    public function index()
    {
        if (! Gate::allows('student_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('student_delete')) {
                return abort(401);
            }
            $students = Student::onlyTrashed()->get();
        } else {
            $students = Student::all();
        }

        return view('manage.students.index', compact('students'));
    }
    public function create()
    {
        if (! Gate::allows('student_create')) {
            return abort(401);
        }       
        
        $enum_gender = Student::$enum_gender;
       
        $depts =  Department::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $batches = \App\Models\Batch::get()->pluck('year', 'id')->prepend(trans('global.app_please_select'), '');
        $programs = \App\Models\Program::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('manage.students.create', compact('enum_gender','batches','depts','programs'));
    }

    /**
     * Store a newly created Student in storage.
     *
     * @param  \App\Http\Requests\StoreStudentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentsRequest $request)
    {
        if (! Gate::allows('student_create')) {
            return abort(401);
        }

        $student = Student::create($request->all());
        return redirect()->route('manage.students.index');
    }
    public function imgUpload(Request $request){
  
        if($file = $request->file('image')) {
            
            try {
                
                $this->storeAttachment($file); // Store file pysically 

                // $temp['file_name'] = $this->getPublicUrlPath($attachment->hashName());


                // $name = time().$file->getClientOriginalName();

                // $file->move('images', $name);

                $id = $request->id;

                $student = Student::findOrFail($id);

                if($student) {
                    $student->image = $this->getPublicUrlPath($file->hashName());
                    $student->save();
                }
              }
              catch (\Exception $e) {
                  return $e->getMessage();
              }
               

            }
    } 
    public function upload()
    {
        if (! Gate::allows('student_create')) {
            return abort(401);
        }       

        $depts =  Department::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $batches = \App\Models\Batch::get()->pluck('year', 'id')->prepend(trans('global.app_please_select'), '');
        $programs = \App\Models\Program::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('manage.students.upload', compact('batches','depts','programs'));
    }

    public function bulkstore(Request $request)
    {
        if (! Gate::allows('student_create')) {
            return abort(401);
        }       

        if($request->hasFile('file')){

            $fileData = $request->file('file');
            $export = new StudentImport();
            $export->setParameter($request['dept_id'],$request['batch_id'],$request['program_id']);
          
            Excel::import($export, $request->file('file'));
            
        }

        return redirect()->route('manage.students.index')->with('message','Record successfully saved!');;
    
    }

    /**
     * Show the form for editing Student.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('student_edit')) {
            return abort(401);
        }        $enum_gender = Student::$enum_gender;
            
        $student = Student::findOrFail($id);



        $depts =  Department::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $batches = \App\Models\Batch::get()->pluck('year', 'id')->prepend(trans('global.app_please_select'), '');
        $programs = \App\Models\Program::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('manage.students.edit', compact('student', 'enum_gender','batches','depts','programs'));
    }

    /**
     * Update Student in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentsRequest $request, $id)
    {
        if (! Gate::allows('student_edit')) {
            return abort(401);
        }
        $student = Student::findOrFail($id);
        $student->update($request->all());



        return redirect()->route('manage.students.index');
    }


    /**
     * Display Student.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('student_view')) {
            return abort(401);
        }
        $student = Student::findOrFail($id);

        return view('manage.students.show', compact('student'));
    }


    /**
     * Remove Student from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('student_delete')) {
            return abort(401);
        }
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('manage.students.index');
    }

    /**
     * Delete all selected Student at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('student_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Student::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Student from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('student_delete')) {
            return abort(401);
        }
        $student = Student::onlyTrashed()->findOrFail($id);
        $student->restore();

        return redirect()->route('manage.students.index');
    }

    /**
     * Permanently delete Student from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('student_delete')) {
            return abort(401);
        }
        $student = Student::onlyTrashed()->findOrFail($id);
        $student->forceDelete();

        return redirect()->route('manage.students.index');
    }
    public function getStudentDoc($id)
    {
        
      
        
        $studentDoc = StudentDocument::where('student_id', $id)->get();
        ///return response()->json($entries);

       // $studentDoc = StudentDocument::findOrFail($id);
        $docList = $studentDoc->map(function ($docs) 
        {
            return [ 
                    'id' => $docs->id,
                    'docname' => $docs->doctype->name,
                    'doc_type_id' =>$docs->doc_type_id,
                    'status' => $docs->documentStatus($docs->status),
                    'file_name' =>$docs->file_name,
                ];
        });

        return response()->json($docList);
    }
    public function studentDocUpload(Request $request)
    {	
        $models = (json_decode($request['model']));

        $attachments_input = $request->input('model');
        $attachments_files = $request->file('attachments');

        $attachment_array = [];
        if (count($attachments_files)) {
            foreach ($attachments_files as $key => $value) {
                $model = $models[$key];
                $value[0]->model = $model;
                array_push($attachment_array, $value[0]);
            }
        }

        $attachments = $this->prepareArray($attachment_array);

        $docs=[];
        foreach ($attachments as $attachment) {
            
            $data =  StudentDocument::where(['id'=>$attachment['id'],'doc_type_id'=>$attachment['doc_type_id']])->first();
            
            $data->file_name = $attachment['file_name'];
            $data->status = 3;
            $data->save();
        }


        return response()->json(array(
            'success' => true,
            'data' => $attachments,
            'errors' => []
        ), 200);

    }
    public function getStorageLocation()
	{
		return 'public/attachments';
    }
    public function getPublicUrlPath($name)
	{
		return 'storage/attachments/' . $name;
	}	
    public function storeAttachment($attachment)
	{	
		return $attachment->store($this->getStorageLocation());
	}
    public function prepareArray($attachments = [])
	{	
		$return = [];
		foreach ($attachments as $attachment) {
			$temp = [];
			$this->storeAttachment($attachment); // Store file pysically 
			$temp['file_name'] = $this->getPublicUrlPath($attachment->hashName());
            $temp['id'] = $attachment->model->id;
            $temp['doc_type_id'] = $attachment->model->doc_type_id;

			array_push($return, $temp);
		}
		
		return $return;
    }
    public function approveDoc(Request $request)
	{	

        $data =  StudentDocument::where(['id'=>$request['id'],'doc_type_id'=>$request['doc_type_id']])->first();

        $data->status = 4;
        $data->save();
		
        return response()->json(array(
            'success' => true,
            'data' => $data,
            'errors' => []
        ), 200);
    }

    public function postStudentAddress(Request $request)
    {
        StudentAddress::updateOrCreate(
        ['id' => $request->id], 
        [
            'student_id' => $request->student_id,
            'primary_country' => $request->primary_country,
            'primary_state' => $request->primary_state,
            'primary_district' => $request->primary_district,
            'primary_city' => $request->primary_city,
            'primary_street' => $request->primary_street,
            'ward_no' => $request->ward_no,
            'house_no' => $request->house_no,
            'primary_postal_address' => $request->primary_postal_address,
            'temp_country' => $request->temp_country,
            'temp_state' => $request->temp_state,
            'temp_district' => $request->temp_district,
            'temp_city' => $request->temp_city,
            'temp_street' => $request->temp_street,
            'temp_ward_no' => $request->temp_ward_no,
            'temp_house_no' => $request->temp_house_no,
            'temp_postal_address'=> $request->temp_postal_address
        ]
    );

    

    }
    public function pullStudentAddress($id)
    {

        $studentDoc = StudentAddress::where('student_id', $id)->first();//->get();
        return response()->json($studentDoc);
    }

    public function postStudentQualification(Request $request)
    {
        $data = $request->all();
        //return response()->json($data);
        foreach ($data as $qual) {

        StudentQualification::updateOrCreate(
            ['id' => $qual["id"]], 
            [
                'student_id'     => $qual["student_id"],
                'board' => $qual["board"],// $data->get('year_of_completion'),
                'symbol_no'    => $qual["symbol_no"],// $data->get("symbol_no"),
                'aggregate_percent'   => $qual["aggregate_percent"],// $data->get('aggreagate_percent'),
                'division'       => $qual["division"],
                'year_of_completion' => $qual["year_of_completion"]// $data->get('division'),
            ]);
        }
        //return response()->json($studentQualification);
    }
    public function pullStudentQualification($id)
    {
        $studentQualification = StudentQualification::where('student_id', $id)->get();
        return response()->json($studentQualification);
    }
    public function pullStudentMarks($id)
    {
        $studentMarks = Marks::where('student_id', $id)->get();
        $marks = $studentMarks->map(function ($docs) 
        {
            return [ 
                    'id' => $docs->id,
                    'course_code' =>$docs->courseType->code,
                    'course_name' =>$docs->courseType->name,
                    'attendance' => $docs->attendance,
                    'marks' => $docs->marks,
                ];
        });
        return response()->json($marks);
    }

    
}
