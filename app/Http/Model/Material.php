<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    public $timestamps = false;
    protected $table = 'material';
    protected $primaryKey = 'material_id';
    protected $guarded = [];

}
