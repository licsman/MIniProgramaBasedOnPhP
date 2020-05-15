<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layui</title>
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
    <form class="layui-form" action="{{secure_url('admin/video')}}" method="post">
        <input type="hidden" name="_token" class="tag_token" value="{{csrf_token()}}">
        <div class="layui-form-item">
            <label class="layui-form-label">课程名称</label>
            <div class="layui-input-block">
                <select name="course_id">
                    @foreach($data as $v)<option value="{{$v['course_id']}}">{{$v['course_name']}}</option>@endforeach
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">章节名称</label>
            <div class="layui-input-block">
                <input type="text" name="video_name"  lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">章节标题</label>
            <div class="layui-input-block">
                <input type="text" name="video_title"  lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">教学内容简介</label>
            <div class="layui-input-block">
                <textarea name="video_description"   lay-verify="required" placeholder="请输入内容" class="layui-textarea"></textarea>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">教学视频源</label>
            <div class="layui-input-block">
                <input id="video_file" type="text" name="video_file" placeholder="上传后自动填写，支持mp4等视频格式" value="" class="layui-input">
                <button type="button" class="layui-btn" id="test5"><i class="layui-icon"></i>上传视频</button>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">章节排序</label>
            <div class="layui-input-block">
                <input type="text" name="video_order"  lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
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
        upload.render({
            elem: '#test5'
            ,data:{'_token':tag_token}
            ,url: '{{secure_url('admin/uploadVideo')}}'
            ,accept: 'video' //视频
            ,done: function(res){
                if(res.status == 1){
                    return layer.msg('上传失败');
                }else{//上传成功
                    layer.msg(res.msg);
                    $('#video_file').attr('value', res.filepath); //视频链接（base64）
                }
            }
        });
    });
</script>
</body>
</html>