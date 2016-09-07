更改用户信息

<form action="<?= url(['\Module\Account\Controller\User::update', $user['id']]) ?>" method="post">
    <label>用户名： <input type="text" name="username" value="<?= $user['username'] ?>"/></label><br>
    <label>密码： <input type="text" name="password" value=""/></label><br>
    <label>昵称： <input type="text" name="nickname" value="<?= $user['nickname'] ?>"/></label><br>
    <label>邮箱： <input type="text" name="email" value="<?= $user['email'] ?>"/></label><br>
    <label>状态： <input type="text" name="status" value="<?= $user['status'] ?>"/></label><br>
    <input type="submit" value="SUBMIT"/>

</form>