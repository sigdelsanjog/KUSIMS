<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    //
    use SoftDeletes;

	protected $dates = ['deleted_at'];
    
	
    protected $table = 'school';

    // public function getStatusAttribute($value)
    // {
    //     if($value == 1){return 'Active';}
    //     if($value == 0){return 'InActive';}
    //     return $value; //if your status value is not 1 or 0 it will return the exact value of status
    // }

}
