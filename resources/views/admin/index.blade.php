<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>苗嘉伟毕设-小程序后台管理</title>
    <link rel="stylesheet" href="{{secure_asset('resources/layui/css/layui.css')}}">
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo">苗嘉伟毕设-小程序后台</div>
        <!-- 头部区域（可配合layui已有的水平导航） -->
        <ul class="layui-nav layui-layout-left">
            <li class="layui-nav-item"><a href="">用户</a></li>
            <li class="layui-nav-item">
                <a href="javascript:;">通知消息</a>
                <dl class="layui-nav-child">
                    <dd><a href="">消息管理</a></dd>
                    <dd><a href="">授权管理</a></dd>
                </dl>
            </li>
        </ul>
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:;">
                    <img src="{{secure_asset('uploads').'/'.session('user')['user_thumb']}}" class="layui-nav-img">
                    {{session('user')['user_true_name']}}
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="">基本资料</a></dd>
                    <dd><a href="javascript:;" data-id="14" data-title="密码修改" data-url="{{secure_url('admin/pass')}}"
                           class="site-demo-active" data-type="tabAdd">密码修改</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item"><a href="{{secure_url('admin/exit')}}">退出登录</a></li>
        </ul>
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <!-- 左侧垂直导航区域-->
            <ul class="layui-nav layui-nav-tree" lay-filter="test">
                <li class="layui-nav-item">
                    <a class="" href="javascript:;">小程序课程管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" data-id="1" data-title="全部课程管理" data-url="{{secure_url('admin/course')}}" class="site-demo-active" data-type="tabAdd">全部课程管理</a></dd>
                        <dd><a href="javascript:;" data-id="2" data-title="马上开设课程" data-url="{{secure_url('admin/course/create')}}" class="site-demo-active" data-type="tabAdd">马上开设课程</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a class="" href="javascript:;">课程分类管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" data-id="3" data-title="课程分类管理" data-url="{{secure_url('admin/category')}}" class="site-demo-active" data-type="tabAdd">课程分类管理</a></dd>
                        <dd><a href="javascript:;" data-id="4" data-title="添加课程分类" data-url="{{secure_url('admin/category/create')}}" class="site-demo-active" data-type="tabAdd">添加课程分类</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;">课程视频源管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" data-id="5" data-title="全部教学视频管理" data-url="{{secure_url('admin/video')}}" class="site-demo-active" data-type="tabAdd">全部教学视频管理</a></dd>
                        <dd><a href="javascript:;" data-id="6" data-title="添加教学视频" data-url="{{secure_url('admin/video/create')}}" class="site-demo-active" data-type="tabAdd">发布教学视频</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;">学习路线图及资料管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" data-id="10" data-title="全部学习路线图管理" data-url="{{secure_url('admin/studyway')}}" class="site-demo-active" data-type="tabAdd">全部学习路线图管理</a></dd>
                        <dd><a href="javascript:;" data-id="11" data-title="新增学习路线图" data-url="{{secure_url('admin/studyway/create')}}" class="site-demo-active" data-type="tabAdd">新增学习路线图</a></dd>
                        <dd><a href="javascript:;" data-id="12" data-title="干货资料管理" data-url="{{secure_url('admin/material')}}" class="site-demo-active" data-type="tabAdd">干货资料文章管理</a></dd>
                        <dd><a href="javascript:;" data-id="13" data-title="发布学习资料" data-url="{{secure_url('admin/material/create')}}" class="site-demo-active" data-type="tabAdd">发布资料文章</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;">开课讲师管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" data-id="7" data-title="全部讲师管理" data-url="{{secure_url('admin/teacher')}}" class="site-demo-active" data-type="tabAdd">全部讲师管理</a></dd>
                        <dd><a href="javascript:;" data-id="8" data-title="新增讲师" data-url="{{secure_url('admin/teacher/create')}}" class="site-demo-active" data-type="tabAdd">新增讲师</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;">学生情况管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" data-id="9" data-title="全部学生管理" data-url="{{secure_url('admin/student')}}" class="site-demo-active" data-type="tabAdd">全部学生管理</a></dd>
                    </dl>
                </li>

            </ul>
        </div>
    </div>

    <!--tab标签-->
    <div class="layui-tab" lay-filter="demo" lay-allowclose="true" style="margin-left: 200px;">
        <ul class="layui-tab-title"></ul>
        <div class="layui-tab-content"></div>
    </div>

    <div class="layui-footer" style="text-align:center;">
        <!-- 底部固定区域 -->
        © 即客微信小程序后台管理平台-苗嘉伟19毕业设计
    </div>
</div>
<script src="{{secure_asset('resources/layui/layui.js')}}"></script>
<script>
    layui.use(['element', 'layer', 'jquery'], function () {
        var element = layui.element;
        // var layer = layui.layer;
        var $ = layui.$;
        // 配置tab实践在下面无法获取到菜单元素
        $('.site-demo-active').on('click', function () {
            var dataid = $(this);
            //这时会判断右侧.layui-tab-title属性下的有lay-id属性的li的数目，即已经打开的tab项数目
            if ($(".layui-tab-title li[lay-id]").length <= 0) {
                //如果比零小，则直接打开新的tab项
                active.tabAdd(dataid.attr("data-url"), dataid.attr("data-id"), dataid.attr("data-title"));
            } else {
                //否则判断该tab项是否以及存在
                var isData = false; //初始化一个标志，为false说明未打开该tab项 为true则说明已有
                $.each($(".layui-tab-title li[lay-id]"), function () {
                    //如果点击左侧菜单栏所传入的id 在右侧tab项中的lay-id属性可以找到，则说明该tab项已经打开
                    if ($(this).attr("lay-id") == dataid.attr("data-id")) {
                        isData = true;
                    }
                })
                if (isData == false) {
                    //标志为false 新增一个tab项
                    active.tabAdd(dataid.attr("data-url"), dataid.attr("data-id"), dataid.attr("data-title"));
                }
            }
            //最后不管是否新增tab，最后都转到要打开的选项页面上
            active.tabChange(dataid.attr("data-id"));
        });

        var active = {
            //在这里给active绑定几项事件，后面可通过active调用这些事件
            tabAdd: function (url, id, name) {
                //新增一个Tab项 传入三个参数，分别对应其标题，tab页面的地址，还有一个规定的id，是标签中data-id的属性值
                //关于tabAdd的方法所传入的参数可看layui的开发文档中基础方法部分
                element.tabAdd('demo', {
                    title: name,
                    content: '<iframe data-frameid="' + id + '" scrolling="auto" frameborder="0" src="' + url + '" style="width:100%;height:99%;"></iframe>',
                    id: id //规定好的id
                })
                FrameWH();  //计算ifram层的大小
            },
            tabChange: function (id) {
                //切换到指定Tab项
                element.tabChange('demo', id); //根据传入的id传入到指定的tab项
            },
            tabDelete: function (id) {
                element.tabDelete("demo", id);//删除
            }
        };
        function FrameWH() {
            var h = $(window).height();
            $("iframe").css("height",h+"px");
        }
    });
</script>
</body>
</html>