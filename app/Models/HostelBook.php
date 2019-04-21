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
class HostelBook extends Model
{
    use SoftDeletes;

    protected $fillable = ['student_id', 'remarks','room_id','status'];
    protected $hidden = [];
    
    protected $table = 'hostel_book';

    public function student() {
        return $this->belongsTo(Student::class,'student_id')->withTrashed();;
    }
    public function hostelStatus($id)
    {
        $hostelStatus = [ 
            [ "id" => 1, "name" => 'Not Approved' ],
            [ "id" => 2, "name" => 'Not Qualified' ],
            [ "id" => 3, "name" => 'Approved' ],
            [ "id" => 4, "name" => 'Hostel Left' ],
            [ "id" => 5, "name" => 'Living' ],
        ];


        foreach ( $hostelStatus as $element ) {
            if ( $id == $element['id'] ) {
                return $element['name'];
            }
        }
    
        return false;
        }

    public function hostel(){
        return $this->belongsTo(Hostelroom::class,'room_id');
    }

}