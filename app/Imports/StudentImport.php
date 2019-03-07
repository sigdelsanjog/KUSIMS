<?php

namespace App\Imports;

use App\User;
use App\Models\Student;
use App\Models\DocumentType;
use App\Models\StudentDocument;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentImport implements ToCollection,WithHeadingRow
{
    
    //use Importable;
    /**
     * @param array $row
     *
     * @return User|null
     */

    private $dept_id;
    private $batch_id;
    private $program_id;
    
    public function setParameter(int $dept_id, int $batch_id, int $program_id)
    {
        $this->dept_id = $dept_id;
        $this->batch_id = $batch_id;
        $this->program_id = $program_id;

    }
    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            // dd($row);
            $user = User::create([
                'first_name'=> $row['first_name'],
                'last_name'=> $row['last_name'],
                'middle_name'=> $row['middle_name'],
                'email'=> $row['email'],
                'name'=>$row['first_name'].' '.$row['last_name'],
                'user_type'=>'Student',
                'password'=>Hash::make('admin@123')
            ]);
            
            $roles = ['student'];
            $user->assignRole($roles);

            $student = $user->student()->create([
                'first_name'=> $row['first_name'],
                'last_name'=> $row['last_name'],
                'middle_name'=> $row['middle_name'],
                'email'=> $row['email'],
                'phone'=>$row['phone'],
                'mobile_phone'=>$row['mobile_phone'],
                'reg_no'=>$row['reg_number'],
                'gender'=>$row['gender'],
                'dept_id'=>$this->dept_id,
                'batch_id'=>$this->batch_id,
                'date_of_birth'=>  $this->transformDate($row['dob']),
                'program_id'=>$this->program_id
            ]);

            //dd($student);

            $doc = DocumentType::all()->map(function(DocumentType $doc) {
                return [
                    'doc_type_id' => $doc->id
                ];
            });

            $docs = DocumentType::get();

            $docId = $docs->map(function ($doc) {
                return ['doc_type_id' => $doc->id,'status'=>1,'file_name'=>null];
            });

            $docModels = [];
            foreach ($docId as $doctype) {
                $docModels[] = new StudentDocument($doctype);
            }
            
            // dd($docModels);
            $student->studentdoc()->saveMany($docModels);
        }
    }
}