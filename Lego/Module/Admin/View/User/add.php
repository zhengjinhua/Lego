<div class="wrapper">

    <div class="panel">
        <header class="panel-heading">
            添加账号
        </header>
        <!-- search-form -->
        <div class="panel-body">

            <form class="form-horizontal" action="<?= url(['\Module\Admin\Controller\User::add']) ?>" method="post"
                  id="myform">

                <div class="form-group">
                    <label for="username" class="col-lg-2 control-label">用户名</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="username" name="info[username]" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-lg-2 control-label">密码</label>
                    <div class="col-lg-6">
                        <input type="password" class="form-control" id="password" name="info[password]" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nickname" class="col-lg-2 control-label">别名</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="nickname" name="info[nickname]" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-lg-2 control-label">邮箱</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="email" name="info[email]" value="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-6 ">
                        <input type="submit" class="btn btn-success" value="提交"/>
                    </div>
                </div>
            </form>

        </div>

        <!-- search-form /-->
    </div>
</div>

