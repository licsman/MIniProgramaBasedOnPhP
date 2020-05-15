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
    <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">查看</a>
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
            ,url: '{{secure_url("admin/courseApi")}}' //数据接口
            ,page: true //开启分页
            ,cols: [[ //表头
                {field: 'course_id', title: '课程ID', sort: true ,width: 80}
                , {field: 'course_name', width: 150 ,title: '课程名称'}
                , {field: 'course_title', width: 150 ,title: '课程标题'}
                , {field: 'course_num', width: 115 ,title: '课程章节'}
                , {field: 'cate_name', title: '课程类别', width: 160}
                , {field: 'course_teacher', title: '开课导师', width: 130}
                , {field: 'course_view', title: '学习人数', width: 95}
                , {field: 'course_thumb', title: '课程缩略图', width: 110}
                , {field: 'course_createTime', title: '发布时间', width: 140}
                , {fixed: 'right', width:180, title: '相关操作',align:'center', toolbar: '#barDemo'}
            ]]
        });


        //监听工具条
        table.on('tool(test)', function(obj){
            var data = obj.data;
            if(obj.event === 'detail'){
                layer.open({
                    offset:'t',
                    title:data.course_name,
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['500px', '400px'], //宽高
                    content: '<img style= "width:490px"src={{secure_url("uploads/").'/'}}'+data.course_thumb+'>'+'</br>'+'【课程简介】'+'</br>'+data.course_description
                });
            } else if(obj.event === 'del'){
                layer.confirm('您确定要删除这门课程吗？', {
                    btn: ['确定','取消'] //按钮
                }, function(){
                    $.post("{{secure_url('admin/course/')}}/"+data.course_id,{'_token':'{{csrf_token()}}','_method':'delete'},function (data) {
                        if (data.status==1) {
                            layer.msg(data.msg, {icon: 1});
                            location.reload();
                        }else {
                            layer.msg(data.msg, {icon: 2});
                        }
                    });
                }, function(){});
            } else if(obj.event === 'edit'){
                this.href = "{{secure_url('admin/course/')}}/"+data.course_id+"/edit";
            }
        });

    });
</script>
</body>
</html>