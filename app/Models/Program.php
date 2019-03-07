<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Program
 *
 * @package App
 * @property string $name
 * @property text $description
*/
class Program extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description'];
    protected $hidden = [];
    
    protected $table = 'program';
}