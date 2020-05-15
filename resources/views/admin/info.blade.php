@extends('layouts.layouts')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo;系统基本信息
    </div>
    <!--面包屑导航 结束-->

    <!--结果集标题与导航组件 开始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>快捷操作</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/article')}}"><i class="fa fa-fw fa-list-ul"></i>全部文章</a>
                <a href="{{url('admin/category')}}"><i class="fa fa-fw fa-list-ul"></i>全部分类</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->


    <div class="result_wrap">
        <div class="result_title">
            <h3>系统基本信息</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>操作系统</label><span>{{PHP_OS}}</span>
                </li>
                <li>
                    <label>运行环境</label><span>{{$_SERVER['SERVER_SOFTWARE']}}</span>
                </li>
                <li>
                    <label>PHP运行版本</label><span>{{PHP_VERSION}}</span>
                </li>
                <li>
                    <label>苗嘉伟设计-版本</label><span>v-1.1</span>
                </li>
                <li>
                    <label>上传附件限制</label><span>{{get_cfg_var('upload_max_filesize')}}</span>
                </li>
                <li>
                    <label>北京时间</label><span>{{date('Y-m-d G:i:s')}}</span>
                </li>
                <li>
                    <label>服务器域名/IP</label><span>{{$_SERVER['HTTP_HOST']." ".$_SERVER['SERVER_ADDR']}}</span>
                </li>
                <li>
                    <label>数据库类型</label><span>{{$_SERVER['DB_CONNECTION']}}</span>
                </li>
            </ul>
        </div>
    </div>


    <div class="result_wrap">
        <div class="result_title">
            <h3>使用帮助</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>官方交流网站：</label><span><a href="http://blog.cn/admin/info">http://blog.cn</a></span>
                </li>
                <li>
                    <label>联系我QQ</label><span><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=1328382723&amp;site=qq&amp;menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:1328382723:51" alt="点击这里给我发消息" title="点击这里给我发消息"></a></span>
                </li>
            </ul>
        </div>
    </div>
    <!--结果集列表组件 结束-->
@endsection