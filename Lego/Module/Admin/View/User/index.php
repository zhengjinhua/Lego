<div class="wrapper">
    <div class="panel">
        <header class="panel-heading">
            账号管理
        </header>
        <!-- search-form -->
        <div class="panel-body">
            <form class="form-inline" action="<?= url(['\Module\Admin\Controller\User::index']) ?>" method="GET">
                <div class="form-group">
                    <input class="form-control" type="text" name="keyword"
                           value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>" placeholder="账号"/>
                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i>查询
                    </button>
                    <a class="btn btn-success"
                       href="<?= url(['\Module\Admin\Controller\User::add']) ?>"><i
                                class="fa fa-plus"></i>添加</a>
                </div>
            </form>
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
                <?php if (is_array($list)): ?>
                    <?php foreach ($list as $row): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['username'] ?></td>
                            <td><?= $row['nickname'] ?></td>
                            <td><?= isset($roleIds[$row['id']]) ? $roleName[$roleIds[$row['id']]] : '' ?></td>
                            <td><?= $row['lastip'] ?></td>
                            <td><?= $row['lasttime'] ? date('Y-m-d H:i:s', $row['lasttime']) : '' ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['status'] === 1 ? "激活" : "关闭" ?></td>
                            <td>
                                <a href="<?= url(['\Module\Auth\Controller\Auth::user', $row['id']]) ?>"
                                   class="btn btn-primary btn-xs">授权</a>
                                <a class="btn btn-info btn-xs"
                                   href="<?= url(['\Module\Admin\Controller\User::update', $row['id']]) ?>">编辑
                                </a>
                                <a class="btn btn-warning btn-xs"
                                   href="<?= url(['\Module\Admin\Controller\User::delete', $row['id']]) ?>"
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