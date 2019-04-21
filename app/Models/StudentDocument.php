<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Program
 *
 * @package App
 * @property string $name
 * @property text $description
*/
class StudentDocument extends Model
{
    use SoftDeletes;

    protected $fillable = ['student_id', 'remarks','file_name','doc_type_id','status'];
    protected $hidden = [];
    
    protected $table = 'student_document';

    public function studentdoc()
    {
        return $this->belongsTo(Student::class,'student_id');
    }
    public function documentStatus($id)
    {
        $docStaus = [ 
            [ "id" => 1, "name" => 'Not Upload' ],
            [ "id" => 2, "name" => 'Verified' ],
            [ "id" => 3, "name" => 'Not Approved' ],
            [ "id" => 4, "name" => 'Approved' ],
        ];
        $name = collect($docStaus)->where('id', $id)->first();

        return $name['name'];
    }

    public function doctype(){
        return $this->belongsTo(DocumentType::class,'doc_type_id');
    }

}