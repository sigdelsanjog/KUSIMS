<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    
    protected $fillable = ['name', 'address', 'contact_person', 'notes', 'phone', 'email', 'status', 'block', 'school_id'];

    protected $table = 'department';

    public static function storeValidation($request)
    {
        return [
            'name' => 'max:191|required',
            'school_id' => 'integer|exists:schools,id|max:4294967295|required',
            'address' => 'max:191|nullable',
            'contact_person' => 'max:191|nullable',
            'notes' => 'max:191|nullable',
            'phone' => 'max:191|nullable',
            'email' => 'email|max:191|nullable',
            'status' => 'integer|max:2147483647|nullable',
            'block' => 'integer|max:2147483647|nullable'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'name' => 'max:191|required',
            'school_id' => 'integer|exists:schools,id|max:4294967295|required',
            'address' => 'max:191|nullable',
            'contact_person' => 'max:191|nullable',
            'notes' => 'max:191|nullable',
            'phone' => 'max:191|nullable',
            'email' => 'email|max:191|nullable',
            'status' => 'integer|max:2147483647|nullable',
            'block' => 'integer|max:2147483647|nullable'
        ];
    }

    

    
    
    public function school()
    {
        return $this->belongsTo(School::class, 'school_id')->withTrashed();
    }
    // public function getStatusAttribute($value)
    // {
    //     if($value == 1){return 'Active';}
    //     if($value == 0){return 'InActive';}
    //     return $value; //if your status value is not 1 or 0 it will return the exact value of status
    // }
}
