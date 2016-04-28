<div style="width: 300px;margin: 50px auto">
    <form>
        <div class="form-group">
            <label for="username">账号:</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="账号">
        </div>
        <div class="form-group">
            <label for="password">登陆密码:</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="密码">
            <label for="password2">确认密码:</label>
            <input type="password" class="form-control" name="password2" id="password2" placeholder="密码">
        </div>
        <button type="submit" class="btn btn-default btn-block btn-danger">注册</button>

    </form>
</div>

<script>
    $("button[type=\"submit\"]").click(function(){
        var username = $("input[name=\"username\"]").val();
        var password = $("input[name=\"password\"]").val();
        var password2 = $("input[name=\"password2\"]").val();
        if (username || password){
            $.post("<?=\Core\Router::url(['\Module\Account\Controller\Index::regX'])?>",
                {"username":username,"password":password,"password2":password2},
                function(data){
                    if(data.msg){
                        alert(data.msg);
                        return false;
                    }
                    window.location.assign(data.r)
            },'json');
        }
        return false;
    });
</script>