<?php

namespace App\Models;

use App\Models\Batch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

/**
 * Class Jobtype
 *
 * @package App
 * @property string $name
 * @property string $description
*/
class Student extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'first_name', 
        'middle_name', 
        'last_name', 
        'phone',
        'mobile_phone',
        'gender',
        'nationality',
        'citizenship_no',
        'citizenship_issue_place',
        'citizenship_issue_date',
        'email', 
        'dept_id',
        'user_id',
        'reg_no',
        'date_of_birth',
        'hostel_id',
        'guardian_name',
        'guardian_relation',
        'guardian_contact',
        'guardian_occupation',
        'image',
        'batch_id','program_id'];

    protected $hidden = [];
    public static $enum_gender = ["Male" => "Male", "Female" => "Female"];

    protected $table = 'student';

    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id')->withTrashed();
    }
    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id')->withTrashed();
    }
    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id')->withTrashed();
    }
    public function studentdoc()
    {
        return $this->hasMany(StudentDocument::class);
    }
    public function address()
    {
        return $this->hasMany(StudentAddress::class);
    }
    public function qualification()
    {
        return $this->hasMany(StudentQualification::class);
    }
    public function hostel(){
        return $this->hasMany(HostelBook::class);
    }

    public function setDateOfBirthAttribute($input)
    {
        // dd($input);

        try {
            if ($input != null && $input != '') {
                $this->attributes['date_of_birth'] = Carbon::createFromFormat('Y-m-d H:i:s', $input)->format('Y-m-d');
            } else {
                $this->attributes['date_of_birth'] = null;
            }
        }
        catch (\Exception $err) {
            $this->attributes['date_of_birth'] = Carbon::createFromFormat('Y-m-d', $input)->format('Y-m-d');
        }

       
    }
    public function getImageAttribute()
    {
        if (!$this->attributes['image']) {
            return 'storage/attachments/default_image.png';
        }

        return $this->attributes['image'];
    }
    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDateOfBirthAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }
    // public function student_address()
    // {
    //     return $this->hasOne(StudentAddress::class,'id');
    // }


}
