<?php

namespace App\Mode;

use Illuminate\Database\Eloquent\Model;

class BusAdmin extends Model
{
    //
    protected $table = "bus_admins";
    protected $fillable = [
        'id',
        'first_name', 'middle_name', 'last_name', 'phone', 'email',
        'reg_no', 'dept_id', 'batch_id','bus_stop','user_id','route','status'];
}
