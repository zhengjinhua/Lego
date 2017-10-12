<div class="col-md-3 col-sm-4">
    <div class="list-group">
        <a class="list-group-item active" href="<?= url('/gii/model') ?>"><i class="glyphicon glyphicon-chevron-right"
                                                                             style="float: right;"></i>生成模型</a>
        <a class="list-group-item" href="<?= url('/gii/curd') ?>"><i class="glyphicon glyphicon-chevron-right"
                                                                     style="float: right;"></i>生成CURD</a>
    </div>
</div>

<div class="col-md-9 col-sm-8">
    <div class="default-view">
        <h1>生成模型</h1>

        <p>帮助你生成一个指定表名的LEGO的一个模型活动类<code>默认生成在APP_PATH/Model下</code></p>

        <div class="row">
            <div class="col-lg-8 col-md-10">
                <div class="form-group model">
                    <label class="control-label help" style="cursor:help;">
                        <span data-html="true" data-trigger="hover" data-container="body" data-toggle="popover"
                              data-placement="right" data-content="e.g. <code>gii</code>.">Table Name</span>
                    </label>
                    <input type="text" id="model" class="form-control" name="model">
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" name="generate" id="generate">Generate</button>
                </div>
                <div class="alert alert-success" style="display: none">
                    <a href="#" class="close" data-dismiss="alert">
                        &times;
                    </a>
                    <strong id="modelMsg"></strong>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $("[data-toggle='popover']").popover();

        $("#generate").click(function () {
            submit();
        });
    });

    function submit() {
        $.ajax({
            type: "POST",
            url: "<?= url('/gii/model') ?>",
            data: {model: $("#model").val(), generate: 1},
            dataType: "json",
            success: function (json) {
                $("#modelMsg").text(json.msg);
                if (json.error != 0) {
                    $(".alert").removeClass('alert-success');
                    $(".alert").addClass('alert-danger');
                    $(".alert").css("display", "block");
                    $(".model").addClass('has-error');
                } else {
                    $(".alert").removeClass('alert-danger');
                    $(".alert").addClass('alert-success');
                    $(".alert").css("display", "block");
                    $(".model").addClass('has-success');
                }
            }
        });
    }
</script>