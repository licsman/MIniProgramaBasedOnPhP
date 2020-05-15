<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use App\Http\Model\Course;
use App\Http\Model\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CourseController extends CommonController
{
    //get方式 全部文章主页 admin/course
    public function courseApi()
    {
//        $data = Course::orderBy('course_id','desc')->paginate(11);
        $course = Course::join('courseCate', 'courseCate.cate_id', '=', 'courseContent.cate_id')->get();
        $data['count'] = Course::count('course_id');
        $data['code'] =0;
        $data['msg'] ='';
        $data['data'] =$course;
        return $data;
    }

    //get方式 全部文章主页 admin/course
    public function index()
    {
        return view('admin.course.index');
    }

    //get方式 添加文章 admin/category/create
    public function create()
    {
        $category = new Category();
        $data = $category ->tree();
        $teachers = Teacher::all();
        return view('admin/course/add',compact('data','teachers'));
    }

    //post方式 文章存储  admin/course
    public function store()
    {
        $input = Input::except('_token','file');
        $input['course_createTime']=date('Y-m-d H:i:s',time());
        $teacherInfo = Teacher::where('teacher_name',$input['course_teacher'])->get()->first();
        $course_name = Teacher::find($teacherInfo['teacher_id'])->course_name.' '.$input['course_name'];
        Teacher::find($teacherInfo['teacher_id'])->update(['course_name' => $course_name]);
        $res = Course::create($input);
        if ($res){
            return redirect(secure_url('admin/course'));
        }else{
            return back()->with('errors',array('课程数据添加失败，请稍后再试！'));
        }

    }
    public function edit($course_id)
    {
        $data = (new Category())->tree();
        $filed = Course::find($course_id);
        $teachers = Teacher::all();
        return view('admin.course.edit',compact('data','filed','teachers'));
    }

    //post方式 admin/courseUpdate/{course}
    public function courseUpdate($course_id)
    {
        $input = Input::except('_method','_token','file');
        $res = Course::find($course_id)->update($input);
        if ($res){
            return redirect(secure_url('admin/course'));
        }else{
            return back()->with('errors',array('修改失败，请稍后重试！'));
        }
    }


    //delete方式 admin/course/{course}
    public function destroy($course_id)
    {
        $res = Course::find($course_id)->delete();
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
