<script type="text/javascript">
    $(function () {
        $.formValidator.initConfig({
            autotip: true, formid: "myform", onerror: function (msg) {
            }
        });

        $("#password").formValidator({empty: true, onshow: "长度为6-20位之间", onfocus: "长度为6-20位之间"}).inputValidator({
            min: 6,
            max: 20,
            onerror: "长度为6-20位之间"
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
        $("#loginerrtimes").formValidator({
            onshow: "请输入密码错误次数(大于3表示锁定)",
            onfocus: "请输入密码错误次数(大于3表示锁定)",
            oncorrect: "输入正确"
        }).inputValidator({min: 0, max: 4, onerror: "格式错误，请重新输入"}).regexValidator({
            regexp: "num",
            datatype: "enum",
            onerror: "格式错误，请重新输入"
        });
    });
</script>

<div class="page-heading">
    <h3>
        修改账号【<?= $adminUser['username'] ?>】
    </h3>
</div>

<div class="wrapper">

    <div class="panel">
        <!-- search-form -->
        <div class="panel-body">

            <div class="col-lg-4" style="margin-top:20px;width: auto">
                <form action="<?= url(['\Module\Admin\Controller\User::update', $adminUser['id']]) ?>" method="post"
                      id="myform">
                    <div class="form-inline">

                        <div class="form-group" style="display: block;margin-bottom: 10px;">
                            <input type="text" class="form-control" id="username" name=""
                                   value="<?= $adminUser['username'] ?>"
                                   style="width:200px" disabled>
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
                            <input type="text" class="form-control" id="nickname" name="info[nickname]"
                                   value="<?= $adminUser['nickname'] ?>"
                                   style="width:200px"
                                   placeholder="请输入别名">
                        </div>

                        <div class="form-group" style="display: block;margin-bottom: 10px;">
                            <input type="text" class="form-control" id="email" name="info[email]"
                                   value="<?= $adminUser['email'] ?>"
                                   style="width:200px"
                                   placeholder="请输入邮箱">
                        </div>

                        <div class="form-group" style="display: block;margin-bottom: 10px;">
                            <input type="text" class="form-control" id="loginerrtimes" name="info[loginerrtimes]"
                                   value="<?= $adminUser['loginerrtimes'] ?>"
                                   style="width:200px"
                                   placeholder="请输入密码错误次数">
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

