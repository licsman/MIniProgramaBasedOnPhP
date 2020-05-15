<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $table = 'courseCate';
    protected $primaryKey = 'cate_id';
    protected $guarded = [];

    public function tree()
    {
        $data = $this->get();
        return $data = $this->getTree($data,'cate_name','cate_id','cate_pid');
    }

    public function getTree($data,$filed_name,$filed_id,$filed_pid)
    {
        $arr = array();
        foreach ($data as $m=>$n){
            if ($n->$filed_pid == 0){
                $n['_'.$filed_name]=$n[$filed_name];
                $arr[] = $n;
                foreach ($data as $a=>$b){
                    if ($b->$filed_pid == $n->$filed_id){
                        $b['_'.$filed_name]='|⇨'.$b[$filed_name];
                        $arr[] = $b;
                    }
                }
            }
        }
        return $arr;
    }
}
