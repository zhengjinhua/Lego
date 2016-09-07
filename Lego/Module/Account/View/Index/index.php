<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312"/>
    <title>602-广告管家 用户登录</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <link href="/static/css/style.css" rel="stylesheet">
    <script type="text/javascript" src="/static/js/jquery-1.10.2.min.js"></script>
    <script>
        $(function () {
            $('.tijiao').click(function () {
                $.post($('#testform')[0].action, $('#testform').serialize(), function (date) {
                    if (date.code != 0) {
                        alert(date.msg);
                    }
                }, 'json');
                window.location.href = "<?= url(['\Module\Account\Controller\Home::index']) ?>";
                return false;
            });
        });
    </script>
</head>

<body class="login-body">

<div class="container">


    <form class="form-signin" method="post" action="<?= url(['\Module\Account\Controller\Index::login']) ?>"
          id="testform">
        <div class="form-signin-heading text-center">
            <h1 class="sign-title">602广告管家</h1>
            <img src="/static/images/login-logo.png" alt=""/>
        </div>
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
            <button class="btn btn-lg btn-login btn-block tijiao" type="submit">
                登录
            </button>
        </div>
    </form>

</div>


</body>
</html>
