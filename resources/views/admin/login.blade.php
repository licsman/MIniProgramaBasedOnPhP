@extends('layouts.layouts')
@section('content')
	<style>
		body{
			width: 100%;
			height: 100%;
			background:url("/resources/image/main-bg.jpg");
			background-color: #062045;
			background-size:100% auto;
			background-repeat:no-repeat;
			color: #062045;
		}
		.login_box{
			width: 1000px;
			margin:0 auto;
			border-radius:25px;
			background-color: rgba(255,255,255,0.3);
			box-shadow: 5px 5px 3px rgba(255,255,255,0.4);"
		}
	</style>
	<body>
	<div class="login_box">
		<h1 style="color: rgba(48,243,119,0.8);margin-top: 100px;">welcome!</h1>
		<h2 style="color: #fff">即客小程序后台管理平台</h2>
		<div class="form">
			@if(session('msg'))
				<script>
					layer.msg('{{session('msg')}}');
				</script>
			@endif
			<form action="" method="post">
				{{csrf_field()}}
				<ul>
					<li>
						<input type="text" name="user_name" class="text"/>
						<span><i class="fa fa-user"></i></span>
					</li>
					<li>
						<input type="password" name="user_pass" class="text"/>
						<span><i class="fa fa-lock"></i></span>
					</li>
					<li>
						<input type="text" class="code" name="code"/>
						<span><i class="fa fa-check-square-o"></i></span>
						<img src="{{url('/admin/code')}}" title="点击更换" alt="" onclick="this.src='{{url('/admin/code').'?'.rand(0,1000)}}'"/>
					</li>
					<li>
						<input type="submit" value="立即登陆"/>
					</li>
				</ul>
			</form>
			<p style="color: white">2019.即客小程序后台管理平台</p>
		</div>
	</div>
	</body>
@endsection