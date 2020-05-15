<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Course;
use App\Http\Model\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class TeacherController extends CommonController
{
    //全部职工显示接口
    public function teacherApi()
    {
        //关联查询
        $teacher = Teacher::all();
        $data['code'] =0;
        $data['msg'] ='';
        $data['count'] = Teacher::count('teacher_id');
        $data['data'] =$teacher->toArray();
        return $data;
    }
    //全部职工浏览主页 get方式  admin/teacher
    public function index()
    {
        return view('admin.teacher.index');
    }


    //增加职工信息表单 get方式 admin/teacher/create
    public function create()
    {
//        $data = FoodCate::join('foodcate', 'foodcate.cate_id', '=', 'teacher.cate_id')->get();
        return view('admin.teacher.add');
    }

    //将增加的职工信息存入数据库 post方式 admin/teacher
    public function store()
    {
        $input = Input::except('_token','file');
        $input['teacher_createTime']=date('Y-m-d',time());
        $res = Teacher::create($input);
        if ($res){
            return redirect(secure_url('admin/teacher'));
        }else{
            return back()->with('errors',array('数据添加失败，请稍后再试！'));
        }
    }

    //修改职工信息 get方式  admin/teacher/{teacher}/edit
    public function edit($teacher_id)
    {
        $data = Teacher::find($teacher_id);
        return view('admin/teacher/edit',compact('data'));
    }

    //将修改后的职工信息存入数据库 put方式 admin/teacher/{teacher}
    public function teacherUpdate($teacher_id)
    {
        $input = Input::except('file','_token');
        $res = Teacher::find($teacher_id)->update($input);
        if ($res){
            return redirect(secure_url('admin/teacher'));
        }else{
            return back()->with('errors',array('修改失败，请稍后重试！'));
        }
    }

    //删除职工 delete方式 admin/teacher/{teacher}
    public function destroy($teacher_id)
    {
        $res = Teacher::find($teacher_id)->delete();
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

    //查看职工 get方式  admin/teacher/{teacher}
    public function show()
    {

    }
}
