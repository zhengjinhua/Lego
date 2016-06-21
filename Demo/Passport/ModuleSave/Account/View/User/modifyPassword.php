<div class="home-left">
    <?php include(__DIR__ . '/Common/leftMenu.php'); ?>
</div>
<div class="home-right">
    <form class="form-horizontal">
        <div class="form-group">
            <label for="oldPassword" class="col-sm-2 control-label">旧密码:</label>

            <div class="col-sm-6">
                <input type="text" name="oldPassword" class="form-control" id="oldPassword">
            </div>
        </div>
        <div class="form-group">
            <label for="newPassword" class="col-sm-2 control-label">新密码:</label>

            <div class="col-sm-6">
                <input type="text" name="newPassword" class="form-control" id="newPassword">
            </div>
        </div>
        <div class="form-group">
            <label for="newPassword2" class="col-sm-2 control-label">确认新密码:</label>

            <div class="col-sm-6">
                <input type="text" name="newPassword2" class="form-control" id="newPassword2">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">提交</button>
            </div>
        </div>
    </form>

</div>
