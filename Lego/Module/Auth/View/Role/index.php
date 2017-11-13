<div class="wrapper">
    <div class="panel">
        <header class="panel-heading">
            权限角色列表
        </header>
        <!-- search-form -->
        <div class="panel-body">
            <form class="form-inline" action="<?= url(['\Module\Auth\Controller\Role::index']) ?>">
                <div class="form-group">
                    <input class="form-control" placeholder="名称" name="name" type="text"
                           value="<?= isset($_GET['name']) ? $_GET['name'] : '' ?>"/>
                    <button class="btn btn-default" type="SUBMIT"><i class="fa fa-search"></i> 查询</button>
                </div>
                <div class="form-group">
                    <a class="btn btn-important" href="<?= url(['\Module\Auth\Controller\Role::add']) ?>"><i
                                class="fa fa-plus"></i> 添加 </a>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" id="refresh"><i class="fa fa-refresh"></i> 刷新路由</button>
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
                    <th>角色名称</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($list as $role): ?>
                    <tr>
                        <td><?= $role['id'] ?></td>
                        <td><?= $role['name'] ?></td>
                        <td>
                            <a href="<?= url(['\Module\Auth\Controller\Role::update', $role['id']]) ?>"
                               class="btn btn-info btn-xs">编辑</a>&nbsp;
                            <a href="<?= url(['\Module\Auth\Controller\Auth::action', $role['id']]) ?>"
                               class="btn btn-warning btn-xs">授权</a>&nbsp;
                            <a href="<?= url(['\Module\Auth\Controller\Role::delete', $role['id']]) ?>"
                               onclick="return confirm('确定删除吗?');" class="btn btn-warning btn-xs">删除</a>&nbsp;
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <!-- table /-->
            <?= $Page->show() ?>
        </div>


    </div>
</div>

<script>
    $(function () {
        $("#refresh").click(function () {
            $.ajax({
                type: "GET",
                url: "<?= url(['\Module\Auth\Controller\Action::initDbX']) ?>",
                dataType: "json",
                success: function (json) {
                    if (json.error === 0) {
                        alert(json.msg);
                    }
                }
            });
        });
    });
</script>
