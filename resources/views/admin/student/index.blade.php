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
    <a class="layui-btn layui-btn-xs" lay-event="detail">照片</a>
    <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit">学习情况分析</a>
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
            ,url: '{{secure_url("admin/studentApi")}}' //数据接口
            ,page: true //开启分页
            ,cols: [[ //表头
                {field: 'id', title: '学生ID', sort: true ,width: 80}
                , {field: 'nick_name', width: 120 ,title: '学生昵称'}
                , {field: 'gender', width: 80 ,title: '性别'}
                , {field: 'country', width: 110 ,title: '国家'}
                , {field: 'province', title: '省份', width: 110}
                , {field: 'city', title: '所在城市', width: 130}
                , {field: 'course_name', title: '报名课程', width: 180}
                , {field: 'created_at', title: '创建时间', width: 140}
                , {fixed: 'right', width:250, title: '相关操作',align:'center', toolbar: '#barDemo'}
            ]]
        });


        //监听工具条
        table.on('tool(test)', function(obj){
            var data = obj.data;
            if(obj.event === 'detail'){
                layer.open({
                    offset:'t',
                    title:data.nick_name+'的照片',
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['300px', '400px'], //宽高
                    content: '<img style= "width:300px"src={{secure_url("uploads/").'/'}}'+data.avatar_url+'>'
                });
            } else if(obj.event === 'del'){
                layer.confirm('您确定要移除这名学员吗？', {
                    btn: ['确定','取消'] //按钮
                }, function(){
                    $.post("{{secure_url('admin/student/')}}/"+data.student_id,{'_token':'{{csrf_token()}}','_method':'delete'},function (data) {
                        if (data.status===1) {
                            layer.msg(data.msg, {icon: 1});
                            location.reload();
                        }else {
                            layer.msg(data.msg, {icon: 2});
                        }
                    });
                }, function(){});
            } else if(obj.event === 'edit'){
                var index = layer.open({
                    type: 2,
                    title:data.nick_name+'的学习情况可视化',
                    content: 'https://jiawei.shop/admin/student/show',
                    area: ['900px','700px'],
                    maxmin: true
                });
                layer.full(index);
            }
        });

    });
</script>
</body>
</html>