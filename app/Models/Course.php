<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Course
 *
 * @package App
 * @property string $name
 * @property string $code
 * @property string $description
 * @property enum $status
*/
class Course extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'code', 'description', 'status'];
    protected $hidden = [];
    
    
    protected $table = 'course';


    public static $enum_status = ["Active" => "Active", "In Active" => "In Active"];
    
}