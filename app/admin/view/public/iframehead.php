<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Myblog-后台</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="keywords" content="">
		<meta name="description" content="">
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
		<link rel="stylesheet" href="/src/admin/css/okadmin.css?v={:date('ymd')}">
		<script src="/src/admin/js/jquery.min.js"></script>
	</head>
	<body class="layui-layout-body">
		<div class="layui-layout layui-layout-admin okadmin">
			<!--头部导航-->
			<div class="layui-header okadmin-header">
				<ul class="layui-nav layui-layout-left">
					<li class="layui-nav-item">
						<a class="ok-menu ok-show-menu" href="javascript:" title="菜单切换">
							<i class="layui-icon layui-icon-shrink-right"></i>
						</a>
					</li>
				</ul>
				<ul class="layui-nav layui-layout-right">
					<li class="layui-nav-item">
						<a class="" href="/" target="_blank" title="网站首页">
							<i class="layui-icon layui-icon-home"></i>
						</a>
					</li>
					<li class="layui-nav-item">
						<a class="ok-refresh" href="javascript:" title="刷新">
							<i class="layui-icon layui-icon-refresh-3"></i>
						</a>
					</li>
					<li class="layui-nav-item layui-hide-xs">
						<a id="fullScreen" class=" pr10 pl10" href="javascript:">
							<i class="layui-icon layui-icon-screen-full"></i>
						</a>
					</li>

					<li class="no-line layui-nav-item">
						<a href="javascript:">
							欢迎您
						</a>
						<dl id="userInfo" class="layui-nav-child">
							<dd><a href="javascript:void(0)" id="logout" data-url='{:url("/Login/out/")}'>退出登录</a></dd>
						</dl>
					</li>
				</ul>
			</div>
			<!--遮罩层-->
			<div class="ok-make"></div>
			<!--左侧导航区域-->
			<div class="layui-side layui-side-menu okadmin-bg-20222A ok-left">
				<div class="layui-side-scroll okadmin-side">
					<a href="{:url('/Index')}"><div class="okadmin-logo">MyBlog后台管理</div></a>
					<!--左侧导航菜单-->
					<ul id="navBars" class="layui-nav okadmin-nav okadmin-bg-20222A layui-nav-tree" style="height: 700px;">
						<li class="layui-nav-item">
							<a lay-id="0-1" data-url="{:url('/Index/main')}" is-close="true"><i class="ok-icon"></i><cite>控制台</cite></a>
						</li>
						<li class="layui-nav-item">
							<a><i class="layui-icon"></i><cite>常用页面</cite><span class="layui-nav-more"></span></a>
							<dl class="layui-nav-child">
								<dd class="layui-item">
									<a lay-id="1-1" data-url="{:url('/Article/index')}" is-close="true"><i class="layui-icon"></i><cite>文章列表</cite></a>
								</dd>
							</dl>
							<dl class="layui-nav-child">
								<dd class="layui-item">
									<a lay-id="1-2" data-url="{:url('/Category/index')}" is-close="true"><i class="layui-icon"></i><cite>栏目管理</cite></a>
								</dd>
							</dl>
							<dl class="layui-nav-child">
								<dd class="layui-item">
									<a lay-id="1-3" data-url="{:url('/Background/index')}" is-close="true"><i class="layui-icon"></i><cite>背景图管理</cite></a>
								</dd>
							</dl>
						</li>
					</ul> 
				</div>
			</div>

			<!-- 内容主体区域 -->
			<div class="content-body">
				<div class="layui-tab ok-tab" lay-filter="ok-tab" lay-allowClose="true" lay-unauto>
					<div data-id="left" id="okLeftMove" class="ok-icon ok-icon-back okadmin-tabs-control move-left okNavMove"></div>
					<div data-id="right" id="okRightMove" class="ok-icon ok-icon-right okadmin-tabs-control move-right okNavMove"></div>
					<div class="layui-icon okadmin-tabs-control ok-right-nav-menu" style="right: 0;">
						<ul class="okadmin-tab">
							<li class="no-line okadmin-tab-item">
								<div class="okadmin-link layui-icon-down" href="javascript:;"></div>
								<dl id="tabAction" class="okadmin-tab-child layui-anim-upbit layui-anim">
									<dd><a data-num="1" href="javascript:">关闭当前标签页</a></dd>
									<dd><a data-num="2" href="javascript:">关闭其他标签页</a></dd>
									<dd><a data-num="3" href="javascript:">关闭所有标签页</a></dd>
								</dl>
							</li>
						</ul>
					</div>

					<ul id="tabTitle" class="layui-tab-title ok-tab-title not-scroll">
						<li class="layui-this" lay-id="0-1" tab="index">
							<i class="ok-icon">&#xe654;</i>
							<cite is-close=false>控制台</cite>
						</li>
					</ul>

					<div id="tabContent" class="layui-tab-content ok-tab-content">
						<div class="layui-tab-item layui-show">
							<iframe src="{:url('/index/main')}" frameborder="0" scrolling="yes" width="100%" height="100%"></iframe>
						</div>
					</div>
				</div>
			</div>