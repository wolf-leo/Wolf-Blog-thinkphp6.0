<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Tpt-Blog博客管理系统</title>
        <link rel="stylesheet" href="/src/admin/css/admin.css">
        <link rel="stylesheet" href="/src/admin/layui/css/layui.css?v=1.03">
        <script src="https://apps.bdimg.com/libs/jquery/1.8.0/jquery.min.js"></script>
        <script src="/src/admin/layui/layui.js"></script>
    </head>
    <body>
        <div class="header">
            <h2 class="z cl"><a href="{:url('index/index')}">{$admin_title|default=WEB_TITLE}</a></h2>
            <div class="y cl">
                <a target="_blank" href="{:url('/')}">网站首页</a>
                <a href="{:url('login/out')}">退出</a>
            </div>
        </div>
        <div class="admin">
            <div class="aleft">
                <h3><i class="layui-icon" style="position: relative;right: 3px;top: 1px;font-size: 18px;color: #009688;">&#xe643;</i>操作菜单</h3>
                <ul class="cl">
                    <li><i class="layui-icon">&#xe63c;</i><a href="{:url('Article/index')}">文章管理</a></li>
                    <li><i class="layui-icon">&#xe63c;</i><a href="{:url('Category/index')}">栏目管理</a></li>
                    <li><i class="layui-icon">&#xe63c;</i><a href="{:url('Background/index')}">背景图管理</a></li>
                </ul>
            </div>
        </div>