<div class="home-left">
    <?php include(__DIR__ . '/Common/leftMenu.php');?>
</div>
<div class="home-right">
    <form class="form-horizontal">
        <div class="form-group">
            <label for="nickname" class="col-sm-2 control-label">昵称:</label>

            <div class="col-sm-6">
                <input type="text" name="nickname" class="form-control" id="nickname">
            </div>
        </div>
        <div class="form-group">
            <label for="idcard" class="col-sm-2 control-label">身份证:</label>

            <div class="col-sm-6">
                <input type="text" name="idcard" class="form-control" id="idcard">
            </div>
        </div>
        <div class="form-group">
            <label for="truename" class="col-sm-2 control-label">姓名:</label>

            <div class="col-sm-6">
                <input type="text" name="truename" class="form-control" id="truename">
            </div>
        </div>
        <div class="form-group">
            <label for="birthday" class="col-sm-2 control-label">生日:</label>

            <div class="col-sm-6">
                <input type="text" name="birthday" class="form-control" id="birthday">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">提交</button>
            </div>
        </div>
    </form>
</div>
