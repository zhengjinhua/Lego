<!DOCTYPE html>
<html>
<head>
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
<script>
    var data = <?=json_encode($result)?>;
    window.location.assign(data.r);
</script>
</body>
</html>