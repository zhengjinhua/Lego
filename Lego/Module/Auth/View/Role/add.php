<div class="wrapper">
    <div class="page-heading">
        <div class="title">
            <h3><strong>添加角色</strong></h3>

        </div>
    </div>
    <div class="panel ">
        <div class="panel-body">
            <div class="col-lg-4" style="margin-top:20px;">
                <form action="<?= url(['\Module\Auth\Controller\Role::add']) ?>" method="post">
                    <div class="form-inline">
                        <div class="form-group" style="display: block;margin-bottom: 10px;">
                            <label class="label_show">名称：</label>
                            <input type="text" name="name" class="form-control"/>
                        </div>

                        <div class="from-group text-center" style="width: 210px;">
                            <label class="label_show"></label>
                            <input type="submit" class="btn btn-success " value="提交"/>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
</div>

