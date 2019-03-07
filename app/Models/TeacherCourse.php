<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherCourse extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'teacher_id',
        'program_id',
        'batch_id',
        'course_id',
        'dept_id'];
    protected $hidden = [];
    
    
    protected $table = 'teacher_course';

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
