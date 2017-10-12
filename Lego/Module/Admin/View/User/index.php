<div class="page-heading">
    <h3>
        账号管理
    </h3>
</div>


<div class="wrapper">
    <div class="panel">
        <!-- search-form -->
        <div class="panel-body">
            <div class="form-inline">
                <form action="<?= url(['\Module\Admin\Controller\User::index']) ?>" method="GET">
                    <div class="form-group">
                        <div>
                            <input class="form-control" type="text" name="username"
                                   value="" placeholder="用户名" style="width: 150px;margin-right: 5px;"/>
                            <button class="btn btn-default" type="SUBMIT" name="dosubmit"><i class="fa fa-search"></i>查询
                            </button>
                            <a class="btn btn-success"
                               href="<?= url(['\Module\Admin\Controller\User::add']) ?>"><i
                                    class="fa fa-plus"></i>添加账号</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- search-form /-->
        </div>

        <div class="panel-body">
            <!-- table -->
            <table class="table table-striped table-hover table-bordered text-center">
                <thead>
                <tr>
                    <th>用户ID</th>
                    <th>用户名</th>
                    <th>别名</th>
                    <th>所属角色</th>
                    <th>最后登录IP</th>
                    <th>最后登录时间</th>
                    <th>E-mail</th>
                    <th>状态</th>
                    <th>管理操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if (is_array($lists)): ?>
                    <?php foreach ($lists as $list): ?>
                        <tr>
                            <td><?= $list['id'] ?></td>
                            <td><?= $list['username'] ?></td>
                            <td><?= $list['nickname'] ?></td>
                            <td><?= isset($roleIds[$list['id']]) ? $roleName[$roleIds[$list['id']]] : '' ?></td>
                            <td><?= $list['lastip'] ?></td>
                            <td><?= $list['lasttime'] ? date('Y-m-d H:i:s', $list['lasttime']) : '' ?></td>
                            <td><?= $list['email'] ?></td>
                            <td></td>

                            <td>

                                <a href="<?= url(['\Module\Auth\Controller\Auth::user', $list['id']]) ?>"
                                   class="btn btn-primary btn-xs">授权</a>
                                <a class="btn btn-info btn-xs"
                                   href="<?= url(['\Module\Admin\Controller\User::update', $list['id']]) ?>">修改
                                </a>
                                <a class="btn btn-warning btn-xs"
                                   href="<?= url(['\Module\Admin\Controller\User::delete', $list['id']]) ?>"
                                   onclick="return confirm('确定删除吗？');">删除
                                </a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>

            <?= $Page->show() ?>

        </div>

    </div>
</div>