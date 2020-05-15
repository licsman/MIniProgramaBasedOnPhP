<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public $timestamps = false;
    protected $table = 'courseVideo';
    protected $primaryKey = 'video_id';
    protected $guarded = [];

}
