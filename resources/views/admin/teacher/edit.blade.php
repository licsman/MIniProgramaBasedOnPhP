<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layui</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="stylesheet" href="{{secure_url('resources/layui/css/layui.css')}}"  media="all">
    <script type="text/javascript" src="{{secure_url('resources/views/admin/style/js/jquery.js')}}"></script>
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
    <form class="layui-form" action="{{secure_url('admin/teacherUpdate').'/'.$data->teacher_id}}" method="post">
        <input type="hidden" name="_token" class="tag_token" value="{{csrf_token()}}">
        <div class="layui-form-item">
            <label class="layui-form-label">教师姓名</label>
            <div class="layui-input-block">
                <input type="text" name="teacher_name" value="{{$data->teacher_name}}" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">教师性别</label>
            <div class="layui-input-block">
                <input type="radio" name="teacher_gender" value="男" title="男" @if($data->teacher_gender=='男') checked="" @endif>
                <input type="radio" name="teacher_gender" value="女" title="女" @if($data->teacher_gender=='女') checked="" @endif>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">教师年龄</label>
            <div class="layui-input-block">
                <input type="text" name="teacher_age" value="{{$data->teacher_age}}"  lay-verify="required|number" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">教师简介</label>
            <div class="layui-input-block">
                <textarea name="teacher_description"   lay-verify="required" placeholder="请输入内容" class="layui-textarea">{{$data->teacher_description}}</textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">教师照片</label>
            <div class="layui-input-block">
                <input id="teacher_thumb" type="text" name="teacher_thumb" placeholder="上传后自动填写，支持jpg gif png等图片格式" value="{{$data->teacher_thumb}}" class="layui-input">
            </div>
            <div class="layui-upload">
                <button type="button" name="img_upload" class="layui-btn btn_upload_img">
                    <i class="layui-icon">&#xe67c;</i>上传照片
                </button>
                <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px; width: 300px">
                    预览图：
                    <img style="width: 200px" class="layui-upload-img" src="{{secure_url('uploads').'/'.$data->teacher_thumb}}" id="demo1">
                </blockquote>
                <p id="demoText"></p>
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
    layui.use('upload', function(){
        var upload = layui.upload;
        var tag_token = $(".tag_token").val();
        //普通图片上传
        var uploadInst = upload.render({
            elem: '.btn_upload_img'
            ,type : 'images'
            ,exts: 'jpg|png|gif' //设置一些后缀，用于演示前端验证和后端的验证
            //,auto:false //选择图片后是否直接上传
            //,accept:'images' //上传文件类型
            ,url: '{{secure_url('admin/upload')}}'
            ,data:{'_token':tag_token}
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    $('#demo1').attr('src', result); //图片链接（base64）
                });
            }
            ,done: function(res){
                //如果上传失败
                if(res.status == 1){
                    return layer.msg('上传失败');
                }else{//上传成功
                    layer.msg(res.msg);
                    $('#teacher_thumb').attr('value', res.filepath); //图片链接（base64）
                }
            }
            ,error: function(){
                //演示失败状态，并实现重传
                return layer.msg('上传失败,请重新上传');
            }
        });
    });
</script>
</body>
</html>