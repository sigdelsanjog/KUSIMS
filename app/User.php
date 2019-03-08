<?php
namespace App;
use App\Models\Employee;
use App\Models\Student;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Hash;

/**
 * Class User
 *
 * @package App
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
*/
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $fillable = ['name', 'email', 'password', 'remember_token','user_type','first_name','last_name'];
    
    public static $enum_user_type = ["Employee" => "Employee", "Student" => "Student", "Administrator" => "Administrator", "SuperAdmin" => "SuperAdmin"];
    
    /**
     * Hash password
     * @param $input
     */
    public function setPasswordAttribute($input)
    {
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }
    
    
    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function employee()
    {
        return $this->hasOne(Employee::class,'user_id');
    }
    public function student()
    {
        return $this->hasOne(Student::class,'user_id');
    }

    
}
