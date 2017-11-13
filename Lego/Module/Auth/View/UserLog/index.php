<div class="wrapper">
    <div class="panel">
        <header class="panel-heading">
            管理员操作日志
        </header>
        <!-- search-form /-->
        <div class="panel-body">
            <form class="form-inline" action="<?= url(['\Module\Auth\Controller\UserLog::index']) ?>" method="GET">
                <div class="form-group">
                    <input type="text" class="form-control" name="username"
                           value="<?= isset($_GET['username']) ? trim($_GET['username']) : '' ?>"
                           placeholder="用户名">
                    <button class="btn btn-default" type="SUBMIT" name="dosubmit"><i
                                class="fa fa-search"></i> 查询
                    </button>
                </div>
            </form>
            <!-- search-form /-->
        </div>

        <div class="panel-body">
            <!-- table -->
            <table class="table table-striped table-hover table-bordered text-center">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>用户名</th>
                    <th>Method</th>
                    <th>PathInfo</th>
                    <th>Action</th>
                    <th>创建时间</th>
                </tr>
                </thead>
                <tbody>
                <?php if (is_array($lists)): ?>
                    <?php foreach ($lists as $list): ?>
                        <tr>
                            <td><?= $list['id'] ?></td>
                            <td><?= $list['username'] ?></td>
                            <td><?= $list['method'] ?></td>
                            <td><?= $list['pathinfo'] ?></td>
                            <td><?= $list['action'] ?></td>
                            <td>
                                <?= $list['createtime'] ?>
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