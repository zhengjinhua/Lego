<div class="wrapper">
    <div class="panel">
        <header class="panel-heading">
            {title}
        </header>
        <!-- search-form -->
        <div class="panel-body">
            <form class="form-inline" action="<?= url(['\Module\Admin\Controller\User::index']) ?>" method="GET">
                <div class="form-group">
                    <input class="form-control" type="text" name="keyword"
                           value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>" placeholder="关键词"/>
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
                    <th>ID</th>
                    <th>名称</th>
                    <th>状态</th>
                    <th>管理操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if (is_array($list)): ?>
                    <?php foreach ($list as $row): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['status'] ?></td>
                            <td>
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

            <?= $page->show() ?>

        </div>

    </div>
</div>