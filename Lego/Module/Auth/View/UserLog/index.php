<div class="wrapper">
    <div class="panel">
        <header class="panel-heading">
            管理员操作日志
        </header>
        <!-- search-form /-->
        <div class="panel-body">
            <form class="form-inline" action="<?= url(['\Module\Auth\Controller\UserLog::index']) ?>" method="GET">
                <div class="form-group">
                    <input type="text" class="form-control" name="keyword"
                           value="<?= isset($_GET['keyword']) ? trim($_GET['keyword']) : '' ?>"
                           placeholder="账号">
                    <button class="btn btn-default" type="submit"><i
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
                <?php if (is_array($list)): ?>
                    <?php foreach ($list as $row): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['username'] ?></td>
                            <td><?= $row['method'] ?></td>
                            <td><?= $row['pathinfo'] ?></td>
                            <td><?= $row['action'] ?></td>
                            <td>
                                <?= $row['createtime'] ?>
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