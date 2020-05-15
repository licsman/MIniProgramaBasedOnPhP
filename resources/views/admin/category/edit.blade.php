<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>课程分类管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="stylesheet" href="{{secure_asset('resources/layui/css/layui.css')}}"  media="all">
    <script type="text/javascript" src="{{secure_asset('resources/views/admin/style/js/jquery.js')}}"></script>
    <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
    <style>
        .layui-form-label{
            width: 130px;
        }
        .layui-input-block {
            width: 300px;
            margin-left: 160px;
        }
        .layui-upload{
            margin-left: 160px;
            margin-top: 30px;
        }
        body{
            height: 1100px;
        }
    </style>
</head>
<body>
<div style="width: 1200px;margin-top: 20px">
    @if(count($errors)>0)
        @foreach($errors as $error)
            <script>
                layer.msg({{$error}});
            </script>
        @endforeach
    @endif
    <form class="layui-form" action="{{secure_url('admin/cateUpdate/'.$cate_info->cate_id)}}" method="post">
        <input type="hidden" name="_token" class="tag_token" value="{{csrf_token()}}">
        <div class="layui-form-item">
            <label class="layui-form-label">课程分类名称</label>
            <div class="layui-input-block">
                <input type="text" name="cate_name" value="{{$cate_info->cate_name}}" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">所属类别</label>
            <div class="layui-input-block">
                <select name="cate_pid">
                    <option value="0">根级分类</option>
                    @foreach($data as $v)
                        <option value="{{$v['cate_id']}}"
                                @if($v['cate_id']==$cate_info->cate_pid)
                                selected
                                @endif>{{$v['cate_name']}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">分类标题</label>
            <div class="layui-input-block">
                <input type="text" name="cate_title" value="{{$cate_info->cate_title}}" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">关键词</label>
            <div class="layui-input-block">
                <input type="text" name="cate_keywords" value="{{$cate_info->cate_keywords}}"  lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="*">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>


<script src="{{secure_asset('resources/layui/layui.js')}}"></script>
<script type="text/javascript">
    layui.use('form', function(){
        var form = layui.form;

        //各种基于事件的操作，下面会有进一步介绍
    });
</script>
</body>
</html>