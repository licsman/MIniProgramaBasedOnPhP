<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use App\Http\Model\Studyway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class StudywayController extends CommonController
{
    //get方式 全部资料文章主页 admin/studyway
    public function studywayApi()
    {
//        $data = Studyway::orderBy('studyway_id','desc')->paginate(11);
        $studyway = Studyway::all();
        $data['count'] = Studyway::count('studyway_id');
        $data['code'] =0;
        $data['msg'] ='';
        $data['data'] =$studyway;
        return $data;
    }

    //get方式 全部资料文章主页 admin/studyway
    public function index()
    {
        return view('admin.studyway.index');
    }

    //get方式 添加资料文章 admin/category/create
    public function create()
    {
        return view('admin/studyway/add');
    }

    //post方式 资料文章存储  admin/studyway
    public function store()
    {
        $input = Input::except('_token','file');
        $input['studyway_createTime']=date('Y-m-d H:i:s',time());
        $res = Studyway::create($input);
        if ($res){
            return redirect(secure_url('admin/studyway'));
        }else{
            return back()->with('errors',array('课程数据添加失败，请稍后再试！'));
        }

    }
    public function edit($studyway_id)
    {
        $filed = Studyway::find($studyway_id);
        return view('admin.studyway.edit',compact('filed'));
    }

    //post方式 admin/studywayUpdate/{studyway}
    public function studywayUpdate($studyway_id)
    {
        $input = Input::except('_method','_token','file');
        $res = Studyway::find($studyway_id)->update($input);
        if ($res){
            return redirect(secure_url('admin/studyway'));
        }else{
            return back()->with('errors',array('修改失败，请稍后重试！'));
        }
    }


    //delete方式 admin/studyway/{studyway}
    public function destroy($studyway_id)
    {
        $res = Studyway::find($studyway_id)->delete();
        if ($res){
            $data = [
                'msg'=>'删除成功！',
                'status'=>1
            ];
        }else{
            $data = [
                'msg'=>'删除失败！稍后重试！',
                'status'=>0
            ];
        }
        return $data;
    }

    public function show()
    {
        
    }

}
