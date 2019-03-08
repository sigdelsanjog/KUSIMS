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
class StudentAddress extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'student_id',
        'primary_country',
        'primary_state',
        'primary_district',
        'primary_city',
        'primary_street',
        'ward_no',
        'house_no',
        'primary_postal_address',
        'temp_country',
        'temp_state',
        'temp_district',
        'temp_city',
        'temp_street',
        'temp_ward_no',
        'temp_house_no',
        'temp_postal_address'];
    protected $hidden = [];
    
    
    protected $table = 'student_address';
    
}
