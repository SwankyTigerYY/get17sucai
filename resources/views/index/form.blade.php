<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta http-equiv="Cache-Control" content="no-siteapp">
		<title>简洁搜索 - 极简多引擎主页</title>
		<meta name="author" content="ZhangDi" />
		<meta name="description" content="极简多引擎主页，提供聚合搜索框和网址导航。" />
		<meta name="keywords" content="简洁搜索,极简搜索,简洁导航" />
		<link rel="dns-prefetch" href="{{ URL::asset('/') }}" />
		<link rel="icon" href="{{ URL::asset('search/img/search.png') }}" sizes="192x192" />
		<link rel="apple-touch-icon-precomposed" href="{{ URL::asset('search/img/search.png') }}" />
		<meta name="msapplication-TileImage" content="{{ URL::asset('search/img/search.png') }}" />
		<link rel="shortcut icon" href="{{ URL::asset('search/img/search.png') }}" />
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-touch-fullscreen" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="full-screen" content="yes">
		<!--UC强制全屏-->
		<meta name="browsermode" content="application">
		<!--UC应用模式-->
		<meta name="x5-fullscreen" content="true">
		<!--QQ强制全屏-->
		<meta name="x5-page-mode" content="app">
		<!--CSRF-->
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!--QQ应用模式-->
		<link href="{{ URL::asset('search/font/embed.css') }}" rel="stylesheet">
		<link href="{{ URL::asset('search/css/style.min.css') }}" rel="stylesheet">
		<script src="{{ URL::asset('search/t/font_1592760_frznr49dvo.js') }}"></script>
		<script src="{{ URL::asset('search/t/font_1592665_8irfenx66gf.js') }}"></script>
		<script src="{{ URL::asset('search/js/jquery.min.js') }}"></script>
		<script src="{{ URL::asset('search/js/sou.min.js') }}"></script>
		<link rel="shortcut icon" href="{{ URL::asset('search/img/logo.ico') }}" />
		<link rel="stylesheet" href="{{ URL::asset('search/css/search.min.css') }}" />
		<!-- 百度统计 -->
		<script>
			// console.log('%chttp://www.yunziyuan.com.cn/','color: yellow; background: red; font-size: 24px;font-size:100px')
      </script>

	</head>
	<body>
{{--		<div id="menu"><i></i></div>--}}
{{--		<div class="list closed">--}}
{{--			<ul>--}}
{{--			</ul>--}}
{{--		</div>--}}
		<div id="content">
			<div class="con">
				<div class="shlogo">
					<div class="logo-text embed">简洁&nbsp;&nbsp;搜索</div>
				</div>
				<section class="sousuo">
					<div class="search">
						<div class="search-box">
{{--							<svg class="icon" id="search-icon" aria-hidden="true">--}}
{{--								<use xlink:href="#icon-baidu"></use>--}}
{{--							</svg>--}}
							<form action="{{ url('index') }}" method="post" style="width: 100%">
								{{ csrf_field() }}
								<input type="text" id="" class="search-input" autocomplete="off" autofocus="autofocus" placeholder="请出入页面网址" name="url" style="width: 100%"/>
							</form>
{{--							<svg class="icon" aria-hidden="true" id="search-clear" style="display: none;">--}}
{{--								<use xlink:href="#icon-shanchu"></use>--}}
{{--							</svg>--}}
						</div>
						<!-- 搜索热词 -->
						<div class="box search-hot-text" id="box" style="display: none;">
							<ul></ul>
						</div>
						<!-- 搜索引擎 -->
						<div class="search-engine" style="display: none;">
							<div class="search-engine-head">
								<strong class="search-engine-tit">选择您的默认搜索引擎：</strong>
								<div class="search-engine-tool">
									搜索热词：<label class="switch">
										<input id="hot-btn" type="checkbox">
										<div class="slider round"></div>
									</label>
								</div>
							</div>
							<ul class="search-engine-list"></ul>
						</div>
					</div>
				</section>
			</div>
		</div>
	</body>
	<script src=" {{ URL::asset('search/js/search.min.js') }}"> </script>
	<script src=" {{ URL::asset('search/js/jsonload.js') }}"> </script>
</html>