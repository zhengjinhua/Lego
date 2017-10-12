<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>WebGame Admin</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="<?= _STATIC_URL_ ?>/adminEX/src/js/jquery-1.10.2.min.js"></script>

    <link rel="stylesheet" href="<?= _STATIC_URL_ ?>/adminEX/src/css/style.css">
    <link rel="stylesheet" href="<?= _STATIC_URL_ ?>/adminEX/src/css/style-responsive.css">
    <link rel="stylesheet" href="<?= _STATIC_URL_ ?>/dialog/dialog.css">

    <script>
        $(function () {
            $('.tijiao').click(function () {
                $.post($('#testform')[0].action, $('#testform').serialize(), function (date) {
                    if (date.code == 0) {
                        window.location.href = "<?= url('/home') ?>";
                    } else {
                        alert(date.msg);
                        window.location.href = "/";
                    }
                }, 'json');

                return false;
            });
        });
    </script>

</head>

<body class="login-body">

<div class="container">


    <form class="form-signin" method="post" action="<?= url('/loginX') ?>"
          id="testform">
        <div class="login-wrap">

            <div class="alert alert-block alert-danger" style="display: none;"><strong>用户名或密码错误</strong></div>

            <div class="form-group">
                <label>用户名</label>
                <input class="form-control" type="text" name="username" autofocus>
            </div>

            <div class="form-group">
                <label>密码</label>
                <input class="form-control" type="password" name="password">
            </div>
            <div class="form-group">
                <label>验证码</label>
                <input class="form-control" type="text" name="checkcode">
                <img onclick='this.src=this.src+"?"+Math.random()' src="<?= url('/captcha') ?>">
            </div>
            <button class="btn btn-lg btn-login btn-block tijiao" type="submit">
                登录
            </button>
        </div>
    </form>

</div>


</body>
</html>
