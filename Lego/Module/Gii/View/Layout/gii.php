<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>Gii</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="<?= _STATIC_URL_ ?>/adminEX/src/css/bootstrap.min.css">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="<?= _STATIC_URL_ ?>/adminEX/src/js/jquery-1.10.2.min.js"></script>
    <script src="<?= _STATIC_URL_ ?>/adminEX/src/js/bootstrap.min.js"></script>
</head>

<body style="background: #fff">
<nav class="navbar navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">LEGO</a>
        </div>
        <div>
            <p class="navbar-text navbar-right"><a href="/">应用</a></p>
        </div>
    </div>
</nav>
<div class="container">
    <?= $content ?>
</div>

</body>
</html>