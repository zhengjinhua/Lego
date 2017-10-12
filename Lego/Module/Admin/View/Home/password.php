<script type="text/javascript">
    $(document).ready(function () {
        $.formValidator.initConfig({
            autotip: true, formid: "myform", onerror: function (msg) {
            }
        });
        $("#old_password").formValidator({
            empty: true,
            onshow: "不修改请留空",
            onfocus: "密码长度6-20位",
            oncorrect: "旧密码输入正确"
        }).inputValidator({min: 6, max: 20, onerror: "密码长度6-20位"}).ajaxValidator({
            type: "get",
            url: "<?= url('/home/passwordAjax') ?>",
            data: {old_password: $("#old_password").val()},
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
            onerror: "旧密码输入错误",
            onwait: "请稍等..."
        });

        $("#new_password").formValidator({empty: true, onshow: "不修改请留空", onfocus: "密码长度6-20位"}).inputValidator({
            min: 6,
            max: 20,
            onerror: "密码长度6-20位"
        }).regexValidator({
            regexp: '(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{6,20})$',
            dataType: 'string',
            onerror: '密码必须要同时包含数字与字母 6-20位'
        });
        $("#new_pwdconfirm").formValidator({
            empty: true,
            onshow: "不修改请留空",
            onfocus: "再次输入新的密码",
            oncorrect: "输入正确"
        }).compareValidator({desid: "new_password", operateor: "=", onerror: "两次输入不同"});
    })
</script>
<div class="wrapper">
    <div class="page-heading">
        <div class="title">
            <h3><strong>修改密码</strong></h3>

        </div>
    </div>
    <div class="panel ">
        <div class="panel-body">
            <div class="col-lg-4" style="margin-top:20px;width: auto">
                <form action="<?= url('/home/password') ?>" method="post" id="myform">
                    <div class="form-inline">
                        <div class="form-group" style="display: block;margin-bottom: 10px;">
                            <label class="label_show">当前密码：</label>
                            <input type="password" name="password" id="old_password" class="form-control"/>
                        </div>

                        <div class="form-group" style="display: block;margin-bottom: 10px;">
                            <label class="label_show">新密码：</label>
                            <input type="password" name="password_one" id="new_password" class="form-control"/>
                        </div>

                        <div class="form-group" style="display: block;margin-bottom: 10px;">
                            <label class="label_show">再次输入密码：</label>
                            <input type="password" name="password_two" id="new_pwdconfirm" class="form-control"/>
                        </div>


                        <div class="from-group text-center" style="width: 210px;">
                            <label class="label_show"></label>
                            <input type="submit" class="btn btn-success" id="dosubmit" value="提交"/>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

