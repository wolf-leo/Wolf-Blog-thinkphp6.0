<!DOCTYPE html>
<html>
    <head>
        <title>后台管理系统</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="/src/admin/layui/css/layui.css"  media="all">
        <link rel="stylesheet" href="/src/admin/css/login.css">
        <script src="https://apps.bdimg.com/libs/jquery/1.8.0/jquery.min.js"></script>
        <script type="text/javascript" src="/src/admin/layui/lay/dest/layui.all.js"></script>
    <body id="login">
        <div class="login">
            <h2>后台管理</h2>
            <div class="layui-form-item">
                <input type="text" placeholder="账号：admin" required="" lay-verify="required" autocomplete="off" class="layui-input" id="username">
            </div>
            <div class="layui-form-item">
                <input type="password" placeholder="密码：admin" required="" lay-verify="required" autocomplete="off" class="layui-input" id="password">
            </div>
            <div class="layui-form-item">
                <button style="padding: 0 102px;" class="layui-btn" lay-submit=""  id="login_sub">立即登录</button>
            </div>
        </div>
        <script>
            $(function () {
                $('#login_sub').click(function () {
                    var username = $('#username').val();
                    var password = $('#password').val();
                    if (!username) {
                        $('#username').focus();
                        return;
                    }
                    if (!password) {
                        $('#password').focus();
                        return;
                    }
                    $.ajax({
                        url: '{:url("login/login")}',
                        type: "post",
                        dataType: "json",
                        cache: false,
                        data: {
                            username: username,
                            password: password,
                        },
                        success: function (msg) {
                            console.log(msg);
                            if (msg.code != '1') {
                                layer.msg(msg.msg);
                                return;
                            } else {
                                window.location.href = '{:url("index/index")}';
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>