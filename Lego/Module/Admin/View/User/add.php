<script type="text/javascript">
    $(function () {
        $.formValidator.initConfig({
            autotip: true, formid: "myform", onerror: function (msg) {
            }
        });

        $("#username").formValidator({onshow: "长度为2-20位之间", onfocus: "长度为2-20位之间"}).inputValidator({
            min: 2,
            max: 20,
            onerror: "长度为2-20位之间"
        }).regexValidator({regexp: "ps_username", datatype: "enum", onerror: "用户名格式错误"}).ajaxValidator({
            type: "get",
            url: "<?= url('/account/ajaxUsername') ?>",
            data: {username: $("#username").val()},
            datatype: "html",
            async: 'false',
            success: function (data) {
                if (data == '1') {
                    return false;
                } else {
                    return true;
                }
            },
            buttons: $("#dosubmit"),
            onerror: "用户名已存在",
            onwait: "请稍等.."
        });
        $("#password").formValidator({onshow: "长度为6-20位之间", onfocus: "长度为6-20位之间"}).inputValidator({
            min: 6,
            max: 20,
            onerror: "长度为6-20位之间"
        }).regexValidator({
            regexp: '(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{6,20})$',
            dataType: 'string',
            onerror: '密码必须要同时包含数字与字母 6-20位'
        });
        $("#pwdconfirm").formValidator({
            onshow: "请再次输入密码",
            onfocus: "请再次输入密码",
            oncorrect: "输入正确"
        }).compareValidator({desid: "password", operateor: "=", onerror: "两次输入不一致"});
        $("#email").formValidator({
            onshow: "请输入正确的邮箱格式",
            onfocus: "请输入正确的邮箱格式",
            oncorrect: "输入正确"
        }).inputValidator({min: 6, max: 32, onerror: "长度为6-32位之间"}).regexValidator({
            regexp: "email",
            datatype: "enum",
            onerror: "邮箱格式不正确"
        });
    });
</script>

<div class="page-heading">
    <h3>
        添加账号
    </h3>
</div>

<div class="wrapper">

    <div class="panel">
        <!-- search-form -->
        <div class="panel-body">

            <div class="col-lg-4" style="margin-top:20px;width: auto">
                <form action="<?= url(['\Module\Admin\Controller\User::add']) ?>" method="post" id="myform">
                    <div class="form-inline">

                        <div class="form-group" style="display: block;margin-bottom: 10px;">
                            <input type="text" class="form-control" id="username" name="info[username]" value=""
                                   style="width:200px"
                                   placeholder="请输入用户名">
                        </div>

                        <div class="form-group" style="display: block;margin-bottom: 10px;">
                            <input type="password" class="form-control" id="password" name="info[password]" value=""
                                   style="width:200px"
                                   placeholder="请输入密码">
                        </div>

                        <div class="form-group" style="display: block;margin-bottom: 10px;">
                            <input type="password" class="form-control" id="pwdconfirm" value="" style="width:200px"
                                   placeholder="请再次输入密码">
                        </div>

                        <div class="form-group" style="display: block;margin-bottom: 10px;">
                            <input type="text" class="form-control" id="nickname" name="info[nickname]" value=""
                                   style="width:200px"
                                   placeholder="请输入别名">
                        </div>

                        <div class="form-group" style="display: block;margin-bottom: 10px;">
                            <input type="text" class="form-control" id="email" name="info[email]" value=""
                                   style="width:200px"
                                   placeholder="请输入邮箱">
                        </div>

                        <div class="from-group text-left" style="width: 210px;">
                            <input type="submit" class="btn btn-success" id="dosubmit" name="dosubmit" value="提交"/>
                        </div>
                    </div>
                </form>

            </div>

            <!-- search-form /-->
        </div>
    </div>

