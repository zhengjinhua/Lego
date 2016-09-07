添加用户

<form action="<?= url(['\Module\Account\Controller\User::add']) ?>" method="post">
    <label>用户名： <input type="text" name="username" value=""/></label><br>
    <label>密码： <input type="text" name="password" value=""/></label><br>
    <label>昵称： <input type="text" name="nickname" value=""/></label><br>
    <label>邮箱： <input type="text" name="email" value=""/></label><br>
    <label>状态： <input type="text" name="status" value=""/></label><br>
    <input type="submit" value="SUBMIT"/>

</form>

