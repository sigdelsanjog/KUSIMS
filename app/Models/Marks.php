<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Marks extends Model
{
    use SoftDeletes;
    protected $fillable = ['student_id', 'course_id','marks','attendance'];
    protected $hidden = [];
    
    protected $table = 'student_marks';

    public function courseType(){
        return $this->belongsTo(Course::class,'course_id');
    }
}