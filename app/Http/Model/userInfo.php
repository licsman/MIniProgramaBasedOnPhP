<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class userInfo extends Model
{
    public $timestamps = false;
    protected $table = 'geekStudy_userInfo';
    protected $primaryKey='open_id';
}
