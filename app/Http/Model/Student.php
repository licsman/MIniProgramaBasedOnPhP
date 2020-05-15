<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $timestamps = false;
    protected $table = 'userInfo';
    protected $primaryKey = 'id';
    protected $guarded = [];

}
