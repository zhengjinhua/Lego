<style>
    .mb{margin-bottom:10px;}
    .name{position: relative;}
    .set-name{position:absolute;width:250px;height:100px;background:#999;z-index:10;display:none;line-height:100px;border-radius:5px;text-align:center;}
    .set-name input{height:25px;display:inline;vertical-align: middle;width:180px;color:#333;line-height:25px;}
</style>




<div class="page-heading">
    <h3>角色信息</h3>
</div>

<div class="wrapper">
    <div class="panel">
        <div class="panel-body">
            <?php foreach ($actions as $action): ?>
                <div class=" col-sm-2 mb" style="width:350px">
                    <div class="ser-list">
                        <div class="name" title="<?= $action['action'] ?>">
                            <input class="actionID" type="checkbox" name="action"value="<?= $action['id'] ?>" <?= in_array($action['id'], $roleActions) ? 'checked' : ''; ?>>
                            <span class="set"><?= $action['name'] ?></span>
                            <div class="set-name">
                                <input type="text" placeholder="修改名称" class="editName">
                                <div class="btn btn-success btn-xs success">确定</div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<script>
    var roleId = <?=$role['id']?>;
    $('input').click(function () {
        var msg ={"roleId": roleId, "actionId": this.value}
        $.post("<?=url(['\Module\Auth\Controller\Auth::actionAuthX'])?>",msg,function ($result) {
                if ($result.error === 0) {
                    console.log('更新成功');
                } else {
                    console.log('更新失败');
                }
            }, 'json');
    })

    $.each($(".col-sm-2"),function(){
        if($(this).find(".set").text()==""){
          $(this).remove()
        }
    })
    $(".name").mouseenter(function(){
        $(this).find(".set-name").show();
    }).mouseleave(function(){
        $(this).find(".set-name").hide();
    })

    function editName(id,name){
        var msg ={id:id,name:name}
        $.post("<?=url(['\Module\Auth\Controller\Action::setNameX'])?>",msg,function(data){
            var json = eval('(' + data + ')');
            if(json.error==0){
                alert('更新成功')
            }
            else{
                alert('更新失败')
            }
        })
    }
     $(".success").click(function(){
            var id = $(this).parent().siblings(".actionID").val();
            var name = $(this).siblings(".editName").val();
            editName(id,name)
        })
</script>
