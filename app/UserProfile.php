<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    //
        /**
     * The following fields are mass assignable.
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 
    'middle_name', 'date_of_birth', 'nationality','phone','image','permanent_address_country',
    'permanent_address_state','permanent_address_district','temp_address_district','temp_address_state','gender','user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
