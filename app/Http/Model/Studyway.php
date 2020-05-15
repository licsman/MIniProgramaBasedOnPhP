<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Studyway extends Model
{
    public $timestamps = false;
    protected $table = 'studyway';
    protected $primaryKey = 'studyway_id';
    protected $guarded = [];

}
