<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Notice extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_type', 'title','description','user_type', 'from_date','to_date'];
    public static $enum_user_type = ["Employee" => "Employee", "Student" => "Student", "Administrator" => "Administrator", "SuperAdmin" => "SuperAdmin"];
    
    protected $hidden = [];
    
    protected $table = 'notice';

}