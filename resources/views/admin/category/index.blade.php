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
            ,width:1000
            ,height: 550
            ,url: '{{secure_url("admin/categoryApi")}}' //数据接口
            ,page: true //开启分页
            ,cols: [[ //表头
                {field: 'cate_id', title: 'ID', sort: true ,width: 90}
                , {field: '_cate_name', width: 150 ,title: '分类名称'}
                , {field: 'cate_title', title: '分类标题', width: 220}
                , {field: 'cate_keywords', title: '分类关键字', width: 200}
                , {field: 'cate_createTime', title: '创建时间', sort: true ,width: 160}
                , {fixed: 'right', width:180, title: '相关操作',align:'center', toolbar: '#barDemo'}
            ]]
        });


        //监听工具条
        table.on('tool(test)', function(obj){
            var data = obj.data;
            if(obj.event === 'detail'){
                layer.msg('课程分类名：'+ data.cate_name);
            } else if(obj.event === 'del'){
                layer.confirm('您确定要删除这项课程分类吗？', {
                    btn: ['确定','取消'] //按钮
                }, function(){
                    $.post("{{secure_url('admin/category/')}}/"+data.cate_id,{'_token':'{{csrf_token()}}','_method':'delete'},function (data) {
                        if (data.status==1) {
                            layer.msg(data.msg, {icon: 1});
                            location.reload();
                        }else {
                            layer.msg(data.msg, {icon: 2});
                        }
                    });
                }, function(){});
            } else if(obj.event === 'edit'){
                this.href = "{{secure_url('admin/category/')}}/"+data.cate_id+"/edit";
            }
        });

    });
</script>
</body>
</html>