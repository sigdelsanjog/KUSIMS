<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Marks extends Model
{
    use SoftDeletes;
    protected $fillable = ['student_id', 'course_id','marks','attendance','dept_id','batch_id','program_id'];
    protected $hidden = [];
    
    protected $table = 'student_marks';

    public function courseType(){
        return $this->belongsTo(Course::class,'course_id');
    }
    public function student() {
        return $this->belongsTo(Student::class,'student_id')->withTrashed();;
    }
    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id')->withTrashed();
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id')->withTrashed();
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id')->withTrashed();
    }
    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id')->withTrashed();
    }
}