<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use App\Http\Model\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class MaterialController extends CommonController
{
    //get方式 全部资料文章主页 admin/material
    public function materialApi()
    {
//        $data = Material::orderBy('material_id','desc')->paginate(11);
        $material = Material::all();
        $data['count'] = Material::count('material_id');
        $data['code'] =0;
        $data['msg'] ='';
        $data['data'] =$material;
        return $data;
    }

    //get方式 全部资料文章主页 admin/material
    public function index()
    {
        return view('admin.material.index');
    }

    //get方式 添加资料文章 admin/category/create
    public function create()
    {
        return view('admin/material/add');
    }

    //post方式 资料文章存储  admin/material
    public function store()
    {
        $input = Input::except('_token','file');
        $input['material_createTime']=date('Y-m-d H:i:s',time());
        $res = Material::create($input);
        if ($res){
            return redirect(secure_url('admin/material'));
        }else{
            return back()->with('errors',array('课程数据添加失败，请稍后再试！'));
        }

    }
    public function edit($material_id)
    {
        $data = (new Category())->tree();
        $filed = Material::find($material_id);
        return view('admin.material.edit',compact('data','filed'));
    }

    //post方式 admin/materialUpdate/{material}
    public function materialUpdate($material_id)
    {
        $input = Input::except('_method','_token','file');
        $res = Material::find($material_id)->update($input);
        if ($res){
            return redirect(secure_url('admin/material'));
        }else{
            return back()->with('errors',array('修改失败，请稍后重试！'));
        }
    }


    //delete方式 admin/material/{material}
    public function destroy($material_id)
    {
        $res = Material::find($material_id)->delete();
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
