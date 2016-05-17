<!DOCTYPE html>
<html lang="zh-CN">
<head>
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
    <style>
        .footer {
            text-align: center;
            padding: 30px 0;
            border-top: 1px solid #e5e5e5;
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
<header class="navbar navbar-static-top navbar-inverse">
    <div class="container">
        <a href="/" class="navbar-brand">Lego Framework</a>
    </div>
</header>
<div class="container" style="min-height: 500px;">
    <?= $content; ?>
</div>
<footer class="footer">
    <div class="container">
    </div>
</footer>
</body>
</html>