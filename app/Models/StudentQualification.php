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
class StudentQualification extends Model
{
    use SoftDeletes;

    protected $fillable = ['student_id','board','year_of_completion','aggregate_percent','symbol_no','division'];
    protected $hidden = [];
    
    
    protected $table = 'student_qualification';
    
}
