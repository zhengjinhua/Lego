<div class="wrapper">
    <div class="panel ">
        <header class="panel-heading">
            修改密码
        </header>
        <div class="panel-body">
            <form class="form-horizontal"
                  action="<?= url('/home/password') ?>" method="post"
                  id="myform">
                <div class="form-group">
                    <label for="password" class="col-lg-2 control-label">当前密码</label>
                    <div class="col-lg-6">
                        <input type="password" class="form-control" id="password" name="password" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password_one" class="col-lg-2 control-label">新密码</label>
                    <div class="col-lg-6">
                        <input type="password" class="form-control" id="password_one" name="password_one" value="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-6 ">
                        <input type="submit" class="btn btn-success" value="提交"/>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

