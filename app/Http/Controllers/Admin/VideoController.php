<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Video;
use App\Http\Model\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class VideoController extends CommonController
{
    public function videoApi()
    {
        $video = Video::join('courseContent', 'courseContent.course_id', '=', 'courseVideo.course_id')->orderBy('video_order','asc')->get();
        $data['count'] = Video::count('video_id');
        $data['code'] =0;
        $data['msg'] ='';
        $data['data'] =$video;
        return $data;
    }

    //get方式，文章分类主页 admin/category
    public function index()
    {
      return view('admin/video/index');
    }


    //get方式 admin/category/create
    public function create()
    {
        $data = Course::all();
        return view('admin/video/add',compact('data',$data));
    }

    //post方式，文章 admin/category
    public function store()
    {
//        $input=Input::all();
        $input=Input::except('_token','file');
        $input['video_createTime']=date('Y-m-d H:i:s',time());
        $res = Video::create($input);
        if ($res){
            return redirect(secure_url('admin/video'));
        }else{
            return back()->with('errors',array('数据添加失败，请稍后再试！'));
        }
    }

    //get方式  admin/category/{category}/edit
    public function edit($video_id)
    {
        $data = Course::all();
        $video_info = Video::find($video_id);
        return view('admin.video.edit',compact('data','video_info'));
    }

    //post方式 admin/category/{category}
    public function videoUpdate($video_id)
    {
        $input = Input::except('file','_token');
        $res = Video::find($video_id)->update($input);
        if ($res){
            return redirect(secure_url('admin/video'));
        }else{
            return back()->with('errors',array('修改失败，请稍后重试！'));
        }
    }

    //delete方式 admin/category/{category}
    public function destroy($video_id)
    {
        $res = Video::find($video_id)->delete();
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

    //get方式  admin/category/{category}
    public function show($video_file)
    {
        return view('admin.video.video')->with('video_file',$video_file);
    }
}
