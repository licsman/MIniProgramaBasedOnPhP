<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Course;
use App\Http\Model\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class StudentController extends CommonController
{
    //全部学生显示接口
    public function studentApi()
    {
        //关联查询
        $student = Student::all();
        $data['code'] =0;
        $data['msg'] ='';
        $data['count'] = Student::count('id');
        $data['data'] =$student->toArray();
        return $data;
    }
    //全部学生浏览主页 get方式  admin/student
    public function index()
    {
        return view('admin.student.index');
    }


    //增加学生信息表单 get方式 admin/student/create
    public function create()
    {

    }

    //将增加的学生信息存入数据库 post方式 admin/student
    public function store()
    {
        
    }

    //修改学生信息 get方式  admin/student/{student}/edit
    public function edit()
    {
    }

    //将修改后的学生信息存入数据库 put方式 admin/student/{student}
    public function studentUpdate()
    {

    }

    //删除学生 delete方式 admin/student/{student}
    public function destroy($id)
    {
        $res = Student::find($id)->delete();
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

    //查看学生 get方式  admin/student/{student}
    public function show()
    {
        return view('admin.student/show1');
    }
}
