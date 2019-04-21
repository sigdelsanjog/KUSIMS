<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hostelblock extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'location', 'incharge', 'contact'];
    protected $hidden = [];

    protected $table = 'hostel_block';
}