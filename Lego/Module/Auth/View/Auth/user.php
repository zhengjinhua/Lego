<div class="page-heading">
    <h3>用户信息</h3>
</div>

<div class="wrapper">
    <div class="panel">
        <div class="panel-body">
            <?php foreach ($roles as $role): ?>
                <div class=" col-sm-2 mb">
                    <div class="col-sm-12 ser-list">
                        <div class="name">
                            <input type="checkbox" name="action"
                                   value="<?= $role['id'] ?>" <?= in_array($role['id'], $userRoles) ? 'checked' : ''; ?>> <?= $role['name'] ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<script>
    var userId = <?=$user['id']?>;

    $('input').click(function () {
        $.post("<?=url(['\Module\Auth\Controller\Auth::userAuthX'])?>",
            {"userId": userId, "roleId": this.value},
            function ($result) {
                console.log($result);
                if ($result.error === 0) {
                    console.log('更新成功');
                } else {
                    console.log('更新失败');
                }
            }, 'json');
    })
</script>