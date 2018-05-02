<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>MOBILE-H5</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="<?= _STATIC_URL_ ?>/adminEX/src/js/jquery-1.10.2.min.js"></script>

    <link rel="stylesheet" href="<?= _STATIC_URL_ ?>/adminEX/src/css/style.css">
    <link rel="stylesheet" href="<?= _STATIC_URL_ ?>/adminEX/src/css/style-responsive.css">
</head>

<body class="sticky-header">
<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side openhidden">

        <!--logo and iconic logo start-->
        <div class="logo">
            <a href="/"><img src="<?= _STATIC_URL_ ?>/adminEX/src/images/logo_icon.png"
                             alt=""><span>MOBILE-H5</span></a>
        </div>
        <div class="logo-icon text-center">
            <a href="/"><img src="<?= _STATIC_URL_ ?>/adminEX/src/images/logo_icon.png" alt=""></a>
        </div>
        <!--logo and iconic logo end-->

        <div class="left-side-inner">

            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
                <?php foreach ($menu as $name => $group): ?>
                    <li class="menu-list <?= isset($group['active']) ? 'nav-active' : ''; ?>">
                        <a href="javascript:void(0)"><i
                                    class="fa <?= $group['icon'] ?>"></i><span><?= $name ?></span></a>
                        <ul class="sub-menu-list">
                            <?php foreach ($group['submenu'] as $subname => $subPath): ?>
                                <li class="<?= isset($subPath['active']) ? 'active' : ''; ?>"><a
                                            href="<?= url([$subPath['path']]) ?>"><?= $subname ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endforeach; ?>

            </ul>
            <!--sidebar nav end-->

        </div>
    </div>
    <!-- left side end-->

    <!-- main content start-->
    <div class="main-content">
        <!-- header section start-->
        <div class="header-section openhidden">
            <a class="toggle-btn"><i class="fa fa-bars"></i></a>
            <!--notification menu start -->
            <div class="menu-right">
                <ul class="notification-menu">
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <?= $_SESSION['user']['username'] ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                            <li><a href="<?= url('/logout') ?>"></i> 退出</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!--notification menu end -->
        </div>
        <!-- header section end-->

        <?= $content; ?>
    </div>
</section>

<!-- Placed js at the end of the document so the pages load faster -->

<script src="<?= _STATIC_URL_ ?>/adminEX/src/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="<?= _STATIC_URL_ ?>/adminEX/src/js/bootstrap.min.js"></script>
<script src="<?= _STATIC_URL_ ?>/adminEX/src/js/jquery.nicescroll.js"></script>
<!--common scripts for all pages-->
<script src="<?= _STATIC_URL_ ?>/adminEX/src/js/scripts.js"></script>
</body>
</html>