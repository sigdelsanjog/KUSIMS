<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
class Notice extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id','user_type', 'title','description','user_type', 'from_date','to_date'];
    public static $enum_user_type = ["Employee" => "Employee", "Student" => "Student", "Administrator" => "Administrator", "SuperAdmin" => "SuperAdmin"];
    
    protected $hidden = [];
    
    protected $table = 'notice';

    public function setFromDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['from_date'] = Carbon::createFromFormat('d/m/Y', $input)->format('Y-m-d');
        } else {
            $this->attributes['from_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getFromDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }
    public function setToDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['to_date'] = Carbon::createFromFormat('d/m/Y', $input)->format('Y-m-d');
        } else {
            $this->attributes['to_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getToDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

}