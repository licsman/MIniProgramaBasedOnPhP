<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class SuperAdmin extends Model
{
    public $timestamps = false;
    protected $table = 'superAdmin';
    protected $primaryKey = 'admin_id';
    protected $guarded = [];

}
