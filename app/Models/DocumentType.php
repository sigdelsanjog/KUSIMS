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
class DocumentType extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    protected $hidden = [];
    
    protected $table = 'document_type';
    
}