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

    protected $fillable = ['year', 'description'];
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
    
}