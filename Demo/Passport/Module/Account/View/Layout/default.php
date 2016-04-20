<!DOCTYPE html>
<html lang="zh-cn" data-lang="zh-cn" data-template="simple" class="lang-zh-cn">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lego框架</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- 可选的Bootstrap主题文件（一般不用引入） -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/static/css/base.css">
</head>

<body>
<div class="page">
    <!--header start-->
    <div class="page-head navbar-default">
        <div class="head">
            <div class="head-logo"><a class="logo" href="">Lego Passport</a></div>
            <!--<div class="navbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">首页</a></li>
                    <li class=""><a href="#">价格</a></li>
                    <li class="nav-dropdown ">
                        <a href="javascript:void(0);">产品</a>
                        <ul class="nav-dropdown-list">
                            <li><a target="_blank" href="#"></a></li>
                            <li><a target="_blank" href="#"></a></li>
                            <li><a target="_blank" href="#"></a></li>
                        </ul>
                    </li>
                    <li class=""><a href="http://www.sinacloud.com/index/support.html">支持中心</a></li>
                    <li class=""><a href="http://www.sinacloud.com/index/typical.html">成功案例</a></li>
                    <li><a href="http://saebbs.com" target="_blank">社区</a></li>
                </ul>
            </div>-->
            <div class="account-dropbox">
                <?php if (isset($_SESSION['islogin'])): ?>
                    <a class="login-a ml10"
                       href="<?= Util::url(['\Module\Account\Controller\User::index']) ?>"><?= $_SESSION['account_name'] ?></a>
                    &nbsp;<span class="divider">|</span>&nbsp;
                    <a href="<?= Util::url(['\Module\Account\Controller\Index::logout']) ?>">退出</a>
                <?php else: ?>
                    <a class="login-a ml10" href="<?= Util::url(['\Module\Account\Controller\Index::login']) ?>">登录</a>
                    &nbsp;<span class="divider">|</span>&nbsp;
                    <a href="<?= Util::url(['\Module\Account\Controller\Index::reg']) ?>">注册</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="container">
        <?= $content; ?>
    </div>
    <footer class="footer">
        <div class="container">
        </div>
    </footer>
</body>
</html>