<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Batch
 *
 * @package App
 * @property integer $year
 * @property text $description
*/
class Batch extends Model
{
    use SoftDeletes;

    protected $fillable = ['year', 'description','month'];
    protected $hidden = [];
    
    protected $table = 'batch';

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setYearAttribute($input)
    {
        $this->attributes['year'] = $input ? $input : null;
    }

    public static function month()
    {
        $months = array(
            1 => 'January', 
            2 => 'February', 
            3 => 'March', 
            4 => 'April', 
            5 => 'May', 
            6 => 'June', 
            7 => 'July', 
            8 => 'August', 
            9 => 'September', 
            10 => 'October', 
            11 => 'November', 
            12 => 'December');
        return $months;
    }
    function getMonthName($monthNumber)
    {
        if(!$monthNumber)
            return "";
        
        return date("F", mktime(0, 0, 0, (int)$monthNumber, 1));
    }

    public function getMonthYearAttribute(){
        return $this->year . ', '. date("F", mktime(0, 0, 0, (int)$this->month, 1));
    }
}