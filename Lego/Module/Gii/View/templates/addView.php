<script type="text/javascript">
    <!--
    $(function () {
        $.formValidator.initConfig({
            autotip: true, formid: "myform", onerror: function (msg) {
            }
        });

        $("#name").formValidator({
            onshow: "请输入游戏游戏名",
            onfocus: "请输入游戏游戏名"
        }).inputValidator({
            min: 2,
            max: 20,
            onerror: "长度为2-20位之间"
        });
    });
    //-->
</script>
<div class="page-heading">
    <h3>
        Add
    </h3>
</div>

<div class="wrapper">

    <div class="panel">
        <!-- search-form -->
        <div class="panel-body">

            <div class="col-lg-4" style="margin-top:20px;width: auto">
                <form action="<?= url(['\Module\ModuleName\Controller\ControllerName::add']) ?>" method="post"
                      id="myform">
                    <div class="form-inline">

                        <div class="form-group" style="display: block;margin-bottom: 10px;">
                            <label class="label_show">游戏名:</label>
                            <input type="text" class="form-control" name="info[name]" id="name" value=""
                                   style="width:520px">
                        </div>

                        <div class="form-group" style="display: block;margin-bottom: 10px;">
                            <label class="label_show">游戏域名:</label>
                            <input type="text" class="form-control" name="info[domain]" id="name" value=""
                                   style="width:520px">
                        </div>

                        <div class="form-group" style="display: block;margin-bottom: 10px;">
                            <label class="label_show">游戏Logo:</label>
                            <input type="text" class="form-control" name="info[img]" id="img" value=""
                                   style="width:520px">
                            <a class="btn btn-success btn-sm"
                               href="javascript:upload('img')">上传附件</a>
                            <!-- 上传到ftp的隐藏域 -->
                            <input type="hidden" name="toftp[]" id="toftp_img" value="">
                        </div>

                        <div class="form-group" style="display: block;margin-bottom: 10px;">
                            <label class="label_show">是否审核:</label>
                            <input type="radio" name="info[status]" class="form-control" value="1" checked> 审核
                            <input type="radio" name="info[status]" class="form-control" value="0"> 未审核
                        </div>

                        <div class="from-group text-center" style="width: 210px;">
                            <label class="label_show"></label>
                            <input type="submit" class="btn btn-success" id="dosubmit" name="dosubmit" value="提交"/>
                        </div>
                    </div>
                </form>

            </div>

            <!-- search-form /-->
        </div>
    </div>
    <script type="text/javascript">
        function upload(id) {
            window.top.art.dialog({id: 'image'}).close();
            window.top.art.dialog({
                title: '上传附件',
                id: 'image',
                iframe: '<?=url('/uploadFile/index/')?>' + id,
                width: '600',
                height: '470'
            }, function () {
                window.top.art.dialog({id: 'image'}).close()
            });
        }
    </script>