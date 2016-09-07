<div class="page-heading">
    <h3>账号管理</h3>
</div>


<div class="wrapper">
    <div class="panel">
        <!-- search-form -->
        <div class="panel-body">
            <div class="form-inline">
                <form action="###">
                    <div class="form-group">
                        <div class="input-group" style="width:220px;">
                            <input class="form-control" placeholder="用户名" name="User[username]" type="text"/>
							<span class="input-group-btn">
								<button class="btn btn-default" type="button"><i class="fa fa-search"></i> 查询</button>
							</span>
                        </div>
                    </div>
                    &nbsp;
                    <div class="form-group">
                        <a class="btn btn-important" href="<?= url(['\Module\Account\Controller\User::add']) ?>"><i
                                class="fa fa-plus"></i> 新建 </a>
                    </div>
                </form>
            </div>
            <!-- search-form /-->
        </div>


        <div class="panel-body">
            <!-- table -->
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>用户名</th>
                    <th>昵称</th>
                    <th>Email</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($list as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['nickname'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['status'] ?></td>
                        <td>
                            <a href="<?= url(['\Module\Account\Controller\User::update', $user['id']]) ?>"
                               class="btn btn-info btn-xs">详细</a>&nbsp;
                            <a href="<?= url(['\Module\Account\Controller\User::delete', $user['id']]) ?>"
                               class="btn btn-warning btn-xs">删除</a>&nbsp;
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <!-- table /-->
            <?= $Page->show() ?>
            <!-- pagenation -->
            <!--<div class="pager_container">
                <ul class="pagination">
                    <li class="first"><a href="/index.php?r=user/admin">首页</a></li>
                    <li class="previous"><a href="/index.php?r=user/admin">前一页</a></li>
                    <li class="page active"><a href="/index.php?r=user/admin">1</a></li>
                    <li class="page"><a href="/index.php?r=user/admin&amp;User_page=2">2</a></li>
                    <li class="page"><a href="/index.php?r=user/admin&amp;User_page=3">3</a></li>
                    <li class="page"><a href="/index.php?r=user/admin&amp;User_page=4">4</a></li>
                    <li class="page"><a href="/index.php?r=user/admin&amp;User_page=5">5</a></li>
                    <li class="page"><a href="/index.php?r=user/admin&amp;User_page=6">6</a></li>
                    <li class="page"><a href="/index.php?r=user/admin&amp;User_page=7">7</a></li>
                    <li class="page"><a href="/index.php?r=user/admin&amp;User_page=8">8</a></li>
                    <li class="next"><a href="/index.php?r=user/admin&amp;User_page=2">下一页</a></li>
                    <li class="last"><a href="/index.php?r=user/admin&amp;User_page=8">尾页</a></li>
                </ul>
            </div>-->
            <!-- pagenation /-->
        </div>


    </div>
</div>