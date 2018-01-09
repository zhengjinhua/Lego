<style>
    .height-30 {
        height: 30px;
    }
</style>

<div class="wrapper">
    <div class="panel">
        <header class="panel-heading">
            角色信息
        </header>
        <?php foreach ($actionGroups as $key => $actions): ?>
            <div class="panel-body">
                <div class="row" style="margin-left : 15px;">
                    <div class="col-lg-2 height-30">
                        <input type="checkbox" class='checkAll' value="<?= $key ?>"> 分类[<?= $key ?>]
                    </div>
                </div>
                <?php foreach ($actions as $action): ?>
                    <div class=" col-lg-3 mb height-30">
                        <div class="col-lg-12 ser-list">
                            <div class="name" title="<?= $action['action'] ?>">
                                <input type="checkbox" class="class-<?= $key ?>" name="action"
                                       value="<?= $action['id'] ?>" <?= in_array($action['id'], $roleActions) ? 'checked' : ''; ?>>
                                <span class="set"><?= !empty($action['name']) ? $action['name'] : $action['action'] ?></span>
                                <a href="<?= url(['\Module\Auth\Controller\Action::update', $action['id']]) ?>"><i
                                            class="fa fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>

    var roleId = <?=$role['id']?>;
    $('input[name="action"]').click(function () {
        $.post("<?=url(['\Module\Auth\Controller\Auth::actionAuthX'])?>",
            {"roleId": roleId, "actionId": this.value},
            function ($result) {
                console.log($result);
                if ($result.error === 0) {
                    console.log('操作成功');
                } else {
                    console.log('操作失败');
                }
            }, 'json');
    });

    $('.checkAll').click(function () {
        var id = this.value;
        $('.class-' + id).click();
    });

</script>
