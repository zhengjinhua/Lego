<div style="width: 300px;margin: 50px auto">
    <form>
        <div class="form-group">
            <label for="identify">登陆名:</label>
            <input type="text" name="identify" class="form-control" id="identify" placeholder="账号/邮箱/手机">
        </div>
        <div class="form-group">
            <label for="password">登陆密码:</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="密码">
        </div>
        <button type="submit" class="btn btn-default btn-block btn-danger">登陆</button>
    </form>
</div>

<script>
    $("button[type=\"submit\"]").click(function () {
        var identify = $("input[name=\"identify\"]").val();
        var password = $("input[name=\"password\"]").val();
        if (identify || password) {
            $.post("<?=\Core\Router::url(['\Module\Account\Controller\Index::loginX'])?>",
                {"identify": identify, "password": password},
                function (data) {
                    if (data.msg) {
                        alert(data.msg);
                        return false;
                    }
                    window.location.assign(data.r)
                }, 'json');
        }
        return false;
    });
</script>