<style>
    .set-name {
        float: right;
        display: block;
    }

    .height-30 {
        height: 30px;
    }

    .alert-modification {
        width: 310px;
        height: 220px;
        position: fixed;
        background: #7a7676;
        left: 50%;
        top: 50%;
        margin: -100px 0 0 -155px;
        transform: scale(0);
        transition: all .5s;
        text-align: center;
        color: #fff;
        border-radius: 10px;
    }

    .alert-modification.action {
        transform: scale(1)
    }

    .alert-modification input {
        width: 80%;
        margin-bottom: 15px;
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
                    <div class="col-sm-2 height-30">
                        <input type="checkbox" class='checkAll' value="<?= $key ?>"> 全选/全不选
                    </div>
                </div>
                <?php foreach ($actions as $action): ?>
                    <div class=" col-sm-3 mb height-30">
                        <div class="col-sm-12 ser-list">
                            <div class="name" title="<?= $action['action'] ?>">
                                <input type="checkbox" class="actionID app <?= $key ?>" name="action"
                                       value="<?= $action['id'] ?>" <?= in_array($action['id'], $roleActions) ? 'checked' : ''; ?>>
                                <span class="set"><?= !empty($action['name']) ? $action['name'] : $action['action'] ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
        <div class="alert-modification">
            <h4>编辑权限名</h4>

            <p class="src"></p>

            <p>分组:<input type="text" name="class"></p>

            <p>节点:<input type="text" name="name"></p>

            <div class="btn btn-success success">确定</div>
            <div class="btn btn-info closed">取消</div>
        </div>
    </div>
</div>

<script>
    var setings = {
        roleId:<?=$role['id']?>,
        msg: {
            id: "",
            name: "",
            index: ""
        },
        editName: function (msg) {
            $.post("<?=url(['\Module\Auth\Controller\Action::setNameX'])?>", msg, function (data) {
                var json = eval('(' + data + ')');
                if (json.error == 0) {
                    alert('操作成功')
                    $(".col-sm-2").eq(setings.msg.index).find(".set").text(setings.msg.name)
                }
                else {
                    alert('操作失败')
                }
                $(".alert-modification").removeClass("action")
            })
        },

        editID: function (_this) {
            var msg = {"roleId": setings.roleId, "actionId": _this.val()}
            $.post("<?=url(['\Module\Auth\Controller\Auth::actionAuthX'])?>", msg, function ($result) {
                if ($result.error === 0) {
                    console.log('操作成功');
                } else {
                    console.log('操作失败');
                }
            }, 'json');

        },
        SetName: function (_this) {
            var url = _this.parent(".name").attr("title");
            var content = _this.siblings(".set").text();
            $(".alert-modification").addClass("action").children(".src").html(url).siblings("input").val(content)
            setings.msg.id = _this.siblings(".actionID").val()
            setings.msg.index = _this.parents(".col-sm-2 ").index()
        },
        Success: function (_this) {
            setings.msg.name = _this.siblings("input").val();
            setings.editName(setings.msg)
        },
        InsertElement: function (_this) {
            var html = "<a class=\"set-name btn btn-info btn-xs\">编辑权限名</a>";
            _this.append(html)
        },
        RemoveElement: function (_this) {
            _this.find(".set-name").remove();
        },
        init: function () {

            $(".name").on("click", ".set-name", function () {
                setings.SetName($(this))
            });

            $(".name").mouseenter(function () {
                setings.InsertElement($(this))
            }).mouseleave(function () {
                setings.RemoveElement($(this))
            });

            $(".success").click(function () {
                setings.Success($(this))
            });

            $(".alert-modification input").focus(function () {
                $(this).val("")
            });

            $(".closed").click(function () {
                $(".alert-modification").removeClass("action")
            });

            $('.ser-list .actionID').click(function () {
                setings.editID($(this))
            })
        }
    };
    setings.init();

</script>
