<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Jobtype
 *
 * @package App
 * @property string $name
 * @property string $description
*/
class Jobtype extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description'];
    protected $hidden = [];   

    protected $table = 'jobtype';
}
