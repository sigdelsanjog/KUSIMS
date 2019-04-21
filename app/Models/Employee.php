<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Employee
 *
 * @package App
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $job
 * @property integer $phone_number
 * @property string $email_address
 * @property string $address
 * @property string $dept
 * @property string $qualification
*/
class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'job_id',
        'first_name', 'middle_name', 'last_name', 'phone', 'email', 
        'address', 'qualification', 'dept_id','user_id'];
    protected $hidden = [];
    
    
    protected $table = 'employee';

    /**
     * Set to null if empty
     * @param $input
     */
    public function setJobIdAttribute($input)
    {
        $this->attributes['job_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setPhoneNumberAttribute($input)
    {
        $this->attributes['phone_number'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setDeptIdAttribute($input)
    {
        $this->attributes['dept_id'] = $input ? $input : null;
    }
    
    public function job()
    {
        return $this->belongsTo(Jobtype::class, 'job_id')->withTrashed();
    }
    
    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id')->withTrashed();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }
    
    public function course(){
        return $this->hasMany(TeacherCourse::class, 'store_id','id');
    }
}
