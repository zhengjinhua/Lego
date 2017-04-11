<div class="page-heading">
    <h3>
        Index&nbsp;
        <a class="btn btn-success" href="<?= url(['\Module\ModuleName\Controller\ControllerName::add']) ?>"><i
                class="fa fa-plus"></i>新建</a>
    </h3>
</div>


<div class="wrapper">
    <div class="panel">

        <!-- search-form /-->
        <div class="panel-body">
            <div class="form-inline">
                <form action="<?= url(['\Module\ModuleName\Controller\ControllerName::index']) ?>" method="get">
                    <div class="form-group">
                        <div class="input-group" style="width:200px;">
                            <input class="form-control" placeholder="搜索" name="search" type="text"
                                   value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>"/>
                            <span class="input-group-btn">
								<button class="btn btn-default" type="SUBMIT" name="dosubmit"><i
                                        class="fa fa-search"></i> 查询
                                </button>
							</span>
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
                    <th>ID</th>
                    <th>xx</th>
                    <th>xx</th>
                    <th>xx</th>
                    <th>xx</th>
                    <th>xx</th>
                    <th>管理操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if (is_array($lists)): ?>
                    <?php foreach ($lists as $list): ?>
                        <tr>
                            <td><?= $list['id'] ?></td>
                            <td><?= $list['id'] ?></td>
                            <td><?= $list['id'] ?></td>
                            <td><?= $list['id'] ?></td>
                            <td><?= $list['id'] ?></td>
                            <td><?= $list['id'] ?></td>
                            <td>
                                <a class="btn btn-info btn-xs"
                                   href="<?= url(['\Module\ModuleName\Controller\ControllerName::modify', $list['id']]) ?>">修改
                                </a>
                                <a class="btn btn-warning btn-xs"
                                   href="<?= url(['\Module\ModuleName\Controller\ControllerName::delete', $list['id']]) ?>"
                                   onclick="return confirm('确定删除?');">删除
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