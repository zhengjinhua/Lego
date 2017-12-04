<div class="wrapper">
    <div class="panel">
        <header class="panel-heading">
            用户信息
        </header>
        <div class="panel-body">
            <?php foreach ($roles as $role): ?>
                <div class=" col-lg-3 mb">
                    <div class="col-lg-12 ser-list">
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
                    console.log('操作成功');
                } else {
                    console.log('操作失败');
                }
            }, 'json');
    })
</script>