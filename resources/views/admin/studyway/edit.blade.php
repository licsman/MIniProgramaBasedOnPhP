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
        #layui-input-block1{
            width: 600px;
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
<div style="width: 1200px;height:1600px;margin-top: 20px">
    @if(count($errors)>0)
        @foreach($errors as $error)
            <script>
                layer.msg({{$error}});
            </script>
        @endforeach
    @endif
    <form class="layui-form" action="{{secure_url('admin/studywayUpdate/'.$filed->studyway_id)}}" method="post">
        <input type="hidden" name="_token" class="tag_token" value="{{csrf_token()}}">
        <div class="layui-form-item">
            <label class="layui-form-label">学习路线名称</label>
            <div class="layui-input-block">
                <input type="text" name="studyway_name" value="{{$filed->studyway_name}}" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">学习路线关键词</label>
            <div class="layui-input-block">
                <select name="studyway_tag">
                    <option value="编程语言路线">编程语言路线</option>
                    <option value="平面设计路线">平面设计路线</option>
                    <option value="职业技能路线">职业技能路线</option>
                    <option value="实用英语路线">实用英语路线</option>
                    <option value="升学考研路线">升学考研路线</option>
                    <option value="电商营销路线">电商营销路线</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">学习路线简介</label>
            <div class="layui-input-block">
                <textarea name="studyway_description"   lay-verify="required" placeholder="请输入内容" class="layui-textarea">{{$filed->studyway_description}}</textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">学习路线编辑区</label>
            <div class="layui-input-block" id="layui-input-block1">
                <textarea id="content_demo" name="studyway_content" style="display: none;">{{$filed->studyway_content}}</textarea>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">小编名字</label>
            <div class="layui-input-block">
                <input type="text" name="studyway_editor" value="{{$filed->studyway_editor}}" lay-verify="required" placeholder="编辑昵称" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">学习路线缩略图URL</label>
            <div class="layui-input-block">
                <input id="studyway_thumb" type="text" name="studyway_thumb" value="{{$filed->studyway_thumb}}" placeholder="上传后自动填写，支持jpg gif png等图片格式" value="" class="layui-input">
            </div>
            <div class="layui-upload">
                <button type="button" name="img_upload" class="layui-btn btn_upload_img">
                    <i class="layui-icon">&#xe67c;</i>上传图片
                </button>
                <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px; width: 300px">
                    预览图：
                    <img style="width: 200px" class="layui-upload-img" src="{{secure_url('uploads').'/'.$filed->studyway_thumb}}" id="demo1">
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


<script src="{{secure_url('resources/layui/layui.js')}}"></script>
<script type="text/javascript">
    layui.use('form', function(){
        var form = layui.form;

        //各种基于事件的操作，下面会有进一步介绍
    });
    layui.use('layedit', function(){
        var layedit = layui.layedit;
        var tag_token = $(".tag_token").val();
        layedit.set({
            uploadImage: {
                url: '{{secure_url('admin/imageUpload')}}' //接口url
                ,type: 'post' //默认post
                ,data:{'_token':tag_token}
            }
        });
        layedit.build(
            'content_demo',{
                height: 300
            }

        ); //建立编辑器
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
                    $('#studyway_thumb').attr('value', res.filepath); //图片链接（base64）
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