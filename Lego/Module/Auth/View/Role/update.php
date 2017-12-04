<div class="wrapper">
    <div class="panel ">
        <header class="panel-heading">
            编辑角色
        </header>
        <div class="panel-body">

            <form class="form-horizontal" action="<?= url(['\Module\Auth\Controller\Role::update', $info['id']]) ?>"
                  method="post"
                  id="myform">

                <div class="form-group">
                    <label for="name" class="col-lg-2 control-label">名称</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="name" name="info[name]"
                               value="<?= $info['name'] ?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-6 ">
                        <input type="submit" class="btn btn-success" value="提交"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


