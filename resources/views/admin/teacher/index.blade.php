<html>
<head>
    <meta charset="utf-8">
    <title>table模块快速使用</title>
    <link rel="stylesheet" href="{{secure_url('resources/layui/css/layui.css')}}"  media="all">
    <script type="text/javascript" src="{{secure_url('resources/views/admin/style/js/jquery.js')}}"></script>
</head>
<body>

<table id="demo" lay-filter="test"></table>

<script src="{{secure_url('resources/layui/layui.js')}}"></script>
<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">照片</a>
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<script>
    layui.use('table', function(){
        var table = layui.table;

        //第一个实例
        table.render({
            elem: '#demo'
            ,width:1200
            ,height: 550
            ,url: '{{secure_url("admin/teacherApi")}}' //数据接口
            ,page: true //开启分页
            ,cols: [[ //表头
                {field: 'teacher_id', title: '教师ID', sort: true ,width: 80}
                , {field: 'teacher_name', width: 120 ,title: '姓名'}
                , {field: 'teacher_gender', width: 80 ,title: '性别'}
                , {field: 'teacher_age', width: 115 ,title: '年龄'}
                , {field: 'teacher_description', title: '教师简介', width: 200}
                , {field: 'course_name', title: '讲授课程', width: 200}
                , {field: 'teacher_thumb', title: '教师头像url', width: 120}
                , {field: 'teacher_createTime', title: '开讲时间', width: 120}
                , {fixed: 'right', width:180, title: '相关操作',align:'center', toolbar: '#barDemo'}
            ]]
        });


        //监听工具条
        table.on('tool(test)', function(obj){
            var data = obj.data;
            if(obj.event === 'detail'){
                layer.open({
                    offset:'t',
                    title:data.teacher_name+'的照片',
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['300px', '400px'], //宽高
                    content: '<img style= "width:300px"src={{secure_url("uploads/").'/'}}'+data.teacher_thumb+'>'
                });
            } else if(obj.event === 'del'){
                layer.confirm('您确定要移除这名讲师吗？', {
                    btn: ['确定','取消'] //按钮
                }, function(){
                    $.post("{{secure_url('admin/teacher/')}}/"+data.teacher_id,{'_token':'{{csrf_token()}}','_method':'delete'},function (data) {
                        if (data.status==1) {
                            layer.msg(data.msg, {icon: 1});
                            location.reload();
                        }else {
                            layer.msg(data.msg, {icon: 2});
                        }
                    });
                }, function(){});
            } else if(obj.event === 'edit'){
                this.href = "{{secure_url('admin/teacher/')}}/"+data.teacher_id+"/edit";
            }
        });

    });
</script>
</body>
</html>