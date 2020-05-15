<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public $timestamps = false;
    protected $table = 'courseContent';
    protected $primaryKey = 'course_id';
    protected $guarded = [];

}
