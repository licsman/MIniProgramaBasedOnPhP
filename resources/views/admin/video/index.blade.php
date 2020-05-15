<html>
<head>
    <meta charset="utf-8">
    <title>table模块快速使用</title>
    <link rel="stylesheet" href="{{secure_asset('resources/layui/css/layui.css')}}"  media="all">
    <script type="text/javascript" src="{{secure_asset('resources/views/admin/style/js/jquery.js')}}"></script>
</head>
<body>

<table id="demo" lay-filter="test"></table>

<script src="{{secure_asset('resources/layui/layui.js')}}"></script>
<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">在线播放</a>
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<script>
    layui.use('table', function(){
        var table = layui.table;

        //第一个实例
        table.render({
                elem: '#demo'
                ,width:1300
                ,height: 550
                ,url: '{{secure_url("admin/videoApi")}}' //数据接口
                ,page: true //开启分页
                ,cols: [[ //表头
                    {field: 'video_id', title: 'ID', sort: true ,width: 80}
                    , {field: 'video_name', width: 150 ,title: '视频名称'}
                    , {field: 'course_name', width: 160 ,title: '所属课程'}
                    , {field: 'video_title', title: '视频标题', width: 160}
                    , {field: 'video_description', title: '视频内容', width: 240}
                    , {field: 'video_file', title: '视频源',width: 140}
                    , {field: 'video_createTime', title: '上传时间', sort: true ,width: 160}
                    , {fixed: 'right', width:210, title: '相关操作',align:'center', toolbar: '#barDemo'}
                ]]
        });


        //监听工具条
        table.on('tool(test)', function(obj){
            var data = obj.data;
            if(obj.event === 'detail'){
                layer.open({
                    offset:'t',
                    type: 2,
                    title: data.video_name,
                    area: ['630px', '360px'],
                    shade: 0.8,
                    closeBtn: 0,
                    shadeClose: true,
                    content: '{{secure_url('uploads').'/'}}'+data.video_file
                });
            } else if(obj.event === 'del'){
                layer.confirm('您确定要删除这项课程分类吗？', {
                    btn: ['确定','取消'] //按钮
                }, function(){
                    $.post("{{secure_url('admin/video/')}}/"+data.video_id,{'_token':'{{csrf_token()}}','_method':'delete'},function (data) {
                        if (data.status==1) {
                            layer.msg(data.msg, {icon: 1});
                            location.reload();
                        }else {
                            layer.msg(data.msg, {icon: 2});
                        }
                    });
                }, function(){});
            } else if(obj.event === 'edit'){
                this.href = "{{secure_url('admin/video/')}}/"+data.video_id+"/edit";
            }
        });

    });
</script>
</body>
</html>