<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CategoryController extends CommonController
{

    public function categoryApi()
    {
        $category = new Category();
        $cate = $category ->tree();
        $data['count'] = $category::count('cate_id');
        $data['code'] =0;
        $data['msg'] ='';
        $data['data'] =$cate;
        return $data;
    }

    //get方式，文章分类主页 admin/category
    public function index()
    {
        return view('admin/category/index');
    }

    //get方式 admin/category/create
    public function create()
    {
        $data = Category::where('cate_pid',0)->get();
        return view('admin/category/add',compact('data'));
    }

    //post方式，文章 admin/category
    public function store()
    {
//        $input=Input::all();
        $input=Input::except('_token');
        $input['cate_createTime']=date('Y-m-d H:i:s',time());
        $res = Category::create($input);
        if ($res){
            return redirect(secure_url('admin/category'));
        }else{
            return back()->with('errors',array('数据添加失败，请稍后再试！'));
        }
    }

    //get方式  admin/category/{category}/edit
    public function edit($cate_id)
    {
        $data = Category::where('cate_pid',0)->get();
        $cate_info = Category::find($cate_id);
        return view('admin.category.edit',compact('data','cate_info'));
    }

    //post方式 admin/cateUpdate/{category}
    public function cateUpdate($cate_id)
    {
        $input = Input::except('_method','_token');
        $res = Category::find($cate_id)->update($input);
        if ($res){
            return redirect(secure_url('admin/category'));
        }else{
            return back()->with('errors',array('修改失败，请稍后重试！'));
        }
    }

    //delete方式 admin/category/{category}
    public function destroy($cate_id)
    {
        $res = Category::find($cate_id)->delete();
        //根据一个找出一群符合条件的
        Category::where('cate_pid',$cate_id)->update(['cate_pid'=>0]);
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
    public function show()
    {

    }
}
