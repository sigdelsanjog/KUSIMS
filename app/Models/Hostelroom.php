<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hostelroom extends Model
{
    use SoftDeletes;

    protected $fillable = ['room', 'block_id'];
    protected $hidden = [];
    
    protected $table = 'hostel_room';

    /**
     * Set to null if empty
     * @param $input
     */
    public function setBlockIdAttribute($input)
    {
        $this->attributes['block_id'] = $input ? $input : null;
    }
    
    public function block()
    {
        return $this->belongsTo(Hostelblock::class, 'block_id')->withTrashed();
    }

}