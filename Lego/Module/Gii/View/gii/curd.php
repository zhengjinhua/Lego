<div class="col-md-3 col-sm-4">
    <div class="list-group">
        <a class="list-group-item" href="<?= url('/gii/model') ?>"><i class="glyphicon glyphicon-chevron-right"
                                                                      style="float: right;"></i>生成模型</a>
        <a class="list-group-item active" href="<?= url('/gii/curd') ?>"><i class="glyphicon glyphicon-chevron-right"
                                                                            style="float: right;"></i>生成CURD</a>
    </div>
</div>

<div class="col-md-9 col-sm-8">
    <div class="default-view">
        <h1>生成CURD</h1>

        <p>帮助你生成一个指定模型的LEGO的CURD操作以及视图</p>

        <div class="row">
            <div class="col-lg-8 col-md-10">
                <div class="form-group curd">
                    <label class="control-label" style="cursor:help;">
                        <span data-html="true" data-trigger="hover" data-container="body" data-toggle="popover"
                              data-placement="right" data-content="e.g. <code>GiiModel</code>.">Model Class</span>
                    </label>
                    <input type="text" id="modelClass" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label help" style="cursor:help;">
                        <span data-html="true" data-trigger="hover" data-container="body" data-toggle="popover"
                              data-placement="right" data-content="e.g. <code>Module/Gii/Controller/Gii</code>.">Controller Class</span>
                    </label>
                    <input type="text" id="controllerClass" class="form-control">
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" name="generate" id="generate">Generate</button>
                </div>
                <div class="alert alert-success" style="display: none">
                    <a href="#" class="close" data-dismiss="alert">
                        &times;
                    </a>
                    <strong id="curdMsg"></strong>
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
            url: "<?= url('/gii/curd') ?>",
            data: {modelClass: $("#modelClass").val(), controllerClass: $("#controllerClass").val(), generate: 1},
            dataType: "json",
            success: function (json) {
                $("#curdMsg").text(json.msg);
                if (json.error != 0) {
                    $(".alert").removeClass('alert-success');
                    $(".alert").addClass('alert-danger');
                    $(".alert").css("display", "block");
                } else {
                    $(".alert").removeClass('alert-danger');
                    $(".alert").addClass('alert-success');
                    $(".alert").css("display", "block");
                }
            }
        });
    }
</script>