<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>苗嘉伟毕设-小程序后台管理</title>
    {{--<title>{{\Illuminate\Support\Facades\Config::get('web.admin_title')}}</title>--}}
    <link rel="stylesheet" href="{{secure_asset('resources/views/admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{secure_asset('resources/views/admin/style/font/css/font-awesome.min.css')}}">
    <script type="text/javascript" src="{{secure_asset('resources/views/admin/style/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{secure_asset('resources/views/admin/style/js/ch-ui.admin.js')}}"></script>
    <script type="text/javascript" src="{{secure_asset('resources/org/layer/layer.js')}}"></script>
</head>
@yield('content')
</html>