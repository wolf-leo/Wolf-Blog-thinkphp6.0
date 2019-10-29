<!DOCTYPE html>
<html lang="en" class="page-fill">
	<head>
		<meta charset="UTF-8">
		<title>后台登录</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="keywords" content="">
		<meta name="description" content="">
		<link rel="shortcut icon" href="/src/admin/images/favicon.ico" type="image/x-icon"/>
		<link rel="stylesheet" href="/src/admin/css/oksub.css"/>
		<script src="/src/admin/js/jquery.min.js"></script>
	</head>
	<style>
		.layui-form-item input{
			margin-left: 64px;
			width: 75%;
		}
	</style>
	<body class="page-fill">
		<div class="page-fill" id="login">
			<form class="layui-form">
				<div class="login_face"><img src="/src/admin/images/logo.png"></div>
				<div class="layui-form-item input-item">
					<label for="username">用户名</label>
					<input type="text" lay-verify="required" name="username" placeholder="请输入账号" autocomplete="off" id="username" class="layui-input">
				</div>
				<div class="layui-form-item input-item">
					<label for="password">密码</label>
					<input type="password" lay-verify="required|password" name="password" placeholder="请输入密码" autocomplete="off" id="password" class="layui-input" maxlength="12">
				</div>
				<div class="layui-form-item input-item captcha-box">
					<label for="captcha">验证码</label>
					<input type="text" lay-verify="required|captcha" name="captcha" placeholder="请输入验证码" autocomplete="off" id="captcha" maxlength="4" class="layui-input">
					<div class="img" id='captchaImg' ><img src="{:url('/Login/captcha')}" width="100" height="37" onclick="this.src = '{:url(\'/Login/captcha\')}?time=' + Math.random()" ></div>
				</div>
				<div class="layui-form-item">
					<button class="layui-btn layui-block" lay-filter="login" lay-submit="">登录</button>
				</div>
			</form>
		</div>
		<!--js逻辑-->
		<script src="/src/admin/lib/layui/layui.js"></script>
		<script>
							$(function () {
								setTimeout(function () {
									$('#captchaImg img').trigger('click');
								}, 700);
							});
							layui.use(["form", "okGVerify", "okUtils", "okMock", "okLayer"], function () {
								let form = layui.form;
								let $ = layui.jquery;
								let okUtils = layui.okUtils;
								let okMock = layui.okMock;
								let okLayer = layui.okLayer;
								/**
								 * 数据校验
								 */
								form.verify({
									password: [/^[\S]{6,12}$/, "密码必须6到12位，且不能出现空格"],
								});

								/**
								 * 表单提交
								 */
								form.on("submit(login)", function (data) {
									var url = '{:url("/Login/login")}';
									okUtils.ajax(url, "post", data.field, true).done(function (response) {
										console.log(response);
										okLayer.msg.greenTick(response.msg, function () {
											window.location = "{:url('/Index')}";
										})
									}).fail(function (error) {
										$('#captchaImg img').trigger('click');
										$('#captcha').val('');
									});
									return false;
								});

								/**
								 * 表单input组件单击时
								 */
								$("#login .input-item .layui-input").click(function (e) {
									e.stopPropagation();
									$(this).addClass("layui-input-focus").find(".layui-input").focus();
								});

								/**
								 * 表单input组件获取焦点时
								 */
								$("#login .layui-form-item .layui-input").focus(function () {
									$(this).parent().addClass("layui-input-focus");
								});


								/**
								 * 表单input组件失去焦点时
								 */
								$("#login .layui-form-item .layui-input").blur(function () {
									$(this).parent().removeClass("layui-input-focus");
									if ($(this).val() != "") {
										$(this).parent().addClass("layui-input-active");
									} else {
										$(this).parent().removeClass("layui-input-active");
									}
								})
							});
		</script>
	</body>
</html>
