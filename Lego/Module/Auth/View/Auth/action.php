<div class="page-heading">
    <h3>角色信息</h3>
</div>

<div class="wrapper">
    <div class="panel">
        <div class="panel-body">
            <?php foreach ($actions as $action): ?>
                <div class=" col-sm-2 mb" style="width: 600px">
                    <div class="col-sm-12 ser-list">
                        <div class="name">
                            <input type="checkbox" name="action"
                                   value="<?= $action['id'] ?>" <?= in_array($action['id'], $roleActions) ? 'checked' : ''; ?>> <?= $action['name'] ?>
                            [<?= $action['method'] ?>]<?= $action['action'] ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<script>
    var roleId = <?=$role['id']?>;

    $('input').click(function () {
        $.post("<?=url(['\Module\Auth\Controller\Auth::actionAuthX'])?>",
            {"roleId": roleId, "actionId": this.value},
            function ($result) {
                if ($result.error === 0) {
                    console.log('更新成功');
                } else {
                    console.log('更新失败');
                }
            }, 'json');
    })
</script>