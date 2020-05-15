<html>
<head>
    <meta charset="utf-8">
    <title>学习资料干货总览</title>
    <link rel="stylesheet" href="{{secure_asset('resources/layui/css/layui.css')}}"  media="all">
    <script type="text/javascript" src="{{secure_asset('resources/views/admin/style/js/jquery.js')}}"></script>
</head>
<body>

<table id="demo" lay-filter="test"></table>

<script src="{{secure_asset('resources/layui/layui.js')}}"></script>
<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-warm layui-btn-xs" lay-event="material_content">文章详情</a>
    <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="detail">缩略图</a>
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
            ,url: '{{secure_url("admin/materialApi")}}' //数据接口
            ,page: true //开启分页
            ,cols: [[ //表头
                {field: 'material_id', title: '资料ID', sort: true ,width: 80}
                , {field: 'material_name', width: 150 ,title: '资料名称'}
                , {field: 'material_description', title: '资料简介', width: 130}
                , {field: 'material_content', title: '资料内容', width: 180}
                , {field: 'material_tag', title: '资料关键词', width: 120}
                , {field: 'material_editor', title: '编辑', width: 80}
                , {field: 'material_view', title: '浏览量', width: 90}
                , {field: 'material_thumb', title: '资料缩略图', width: 110}
                , {field: 'material_createTime', title: '发布时间', width: 140}
                , {fixed: 'right', width:260, title: '相关操作',align:'center', toolbar: '#barDemo'}
            ]]
        });


        //监听工具条
        table.on('tool(test)', function(obj){
            var data = obj.data;
            if(obj.event === 'detail'){
                layer.open({
                    offset:'t',
                    title:data.material_name,
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['500px', '350px'], //宽高
                    content: '<html><head></head><body>'+'<img style= "width:490px"src={{secure_url("uploads/").'/'}}'+data.material_thumb+'><body></html>'
                });
            } else if(obj.event === 'del'){
                layer.confirm('您确定要删除这篇资料文章吗？', {
                    btn: ['确定','取消'] //按钮
                }, function(){
                    $.post("{{secure_url('admin/material/')}}/"+data.material_id,{'_token':'{{csrf_token()}}','_method':'delete'},function (data) {
                        if (data.status==1) {
                            layer.msg(data.msg, {icon: 1});
                            location.reload();
                        }else {
                            layer.msg(data.msg, {icon: 2});
                        }
                    });
                }, function(){});
            } if(obj.event === 'material_content'){
                layer.open({
                    offset:'t',
                    title:data.material_name,
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['600px', '350px'], //宽高
                    content: '<html><head></head><body>'+data.material_content+'<body></html>'
                });
            } else if(obj.event === 'edit'){
                this.href = "{{secure_url('admin/material/')}}/"+data.material_id+"/edit";
            }
        });

    });

</script>
</body>
</html>