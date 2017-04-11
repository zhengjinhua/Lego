<script type="text/javascript">
    $(document).ready(function () {
        $.formValidator.initConfig({
            autotip: true, formid: "myform", onerror: function (msg) {
            }
        });
        $("#realname").formValidator({onshow: "请输入真实姓名", onfocus: "长度在2-20位"}).inputValidator({
            min: 2,
            max: 20,
            onerror: "长度在2-20位"
        });
        $("#email").formValidator({
            onshow: "请输入E-mail",
            onfocus: "请输入E-mail",
            oncorrect: "E-mail格式正确"
        }).regexValidator({regexp: "email", datatype: "enum", onerror: "E-mail格式错误"}).ajaxValidator({
            type: "get",
            url: "<?= url('/home/emailAjax') ?>",
            data: {email: $("#email").val()},
            datatype: "html",
            async: 'false',
            success: function (data) {
                if (data == "1") {
                    return true;
                }
                else {
                    return false;
                }
            },
            buttons: $("#dosubmit"),
            onerror: "邮箱已经存在",
            onwait: "请稍等..."
        }).defaultPassed();
    })
</script>
<div class="wrapper">
    <div class="page-heading">
        <div class="title">
            <h3><strong>修改个人信息</strong></h3>

        </div>
    </div>
    <div class="panel ">
        <div class="panel-body">
            <div class="col-lg-4" style="margin-top:20px;">
                <form action="<?= url('/home/memberInfo') ?>" method="post" id="myform">
                    <div class="form-inline">
                        <div class="form-group" style="display: block;margin-bottom: 10px;">
                            <label class="label_show">用户名：</label>
                            <input type="text" value="<?= $user['username'] ?>" class="form-control" disabled/>
                        </div>

                        <div class="form-group" style="display: block;margin-bottom: 10px;">
                            <label class="label_show">最后登录时间：</label>
                            <input type="text" value="<?= date('Y-m-d H:i:s', $user['lasttime']) ?>"
                                   class="form-control" disabled/>
                        </div>

                        <div class="form-group" style="display: block;margin-bottom: 10px;">
                            <label class="label_show">最后登录IP：</label>
                            <input type="text" value="<?= $user['lastip'] ?>" class="form-control" disabled/>
                        </div>

                        <div class="form-group" style="display: block;margin-bottom: 10px;">
                            <label class="label_show">真实姓名：</label>
                            <input type="text" name="nickname" id="nickname" value="<?= $user['nickname'] ?>"
                                   class="form-control"/>
                        </div>

                        <div class="form-group" style="display: block;margin-bottom: 10px;">
                            <label class="label_show">E-mail：</label>
                            <input type="text" name="email" id="email" value="<?= $user['email'] ?>"
                                   class="form-control"/>
                        </div>

                        <div class="from-group text-center" style="width: 210px;">
                            <label class="label_show"></label>
                            <input type="submit" class="btn btn-success " id="dosubmit" value="提交"/>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
</div>

