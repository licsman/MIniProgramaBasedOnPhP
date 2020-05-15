<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public $timestamps = false;
    protected $table = 'teacher';
    protected $primaryKey = 'teacher_id';
    protected $guarded = [];

}
