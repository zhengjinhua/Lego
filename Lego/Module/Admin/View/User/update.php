<div class="wrapper">

    <div class="panel">
        <header class="panel-heading">
            编辑账号
        </header>
        <!-- search-form -->
        <div class="panel-body">

            <form class="form-horizontal"
                  action="<?= url(['\Module\Admin\Controller\User::update', $info['id']]) ?>" method="post"
                  id="myform">

                <div class="form-group">
                    <label for="username" class="col-lg-2 control-label">用户名</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="username" name="info[username]"
                               value="<?= $info['username'] ?>" disabled>
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
                        <input type="text" class="form-control" id="nickname" name="info[nickname]"
                               value="<?= $info['nickname'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-lg-2 control-label">邮箱</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="email" name="info[email]"
                               value="<?= $info['email'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="loginerrtimes" class="col-lg-2 control-label">密码错误次数</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="loginerrtimes" name="info[loginerrtimes]"
                               value="<?= $info['loginerrtimes'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="status" class="col-lg-2 control-label">状态:</label>
                    <div class="col-lg-6">
                        <select name="info[status]" id="status" class="form-control m-bot10">
                            <option value="1" <?= $info['status'] === 1 ? 'selected' : '' ?>>激活</option>
                            <option value="0" <?= $info['status'] === 0 ? 'selected' : '' ?>>关闭</option>
                        </select>
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

