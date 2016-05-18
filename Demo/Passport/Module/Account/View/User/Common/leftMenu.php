<ul class="nav nav-pills  nav-stacked">
    <?php $url = url(['\Module\Account\Controller\User::index']); ?>
    <li role="presentation" <?php if (strpos($url, $_SERVER['PATH_INFO'])) echo 'class="active"' ?>>
        <a href="<?= $url ?>">个人信息</a>
    </li>
    <?php $url = url(['\Module\Account\Controller\User::modifyPassword']); ?>
    <li role="presentation" <?php if (strpos($url, $_SERVER['PATH_INFO'])) echo 'class="active"' ?>>
        <a href="<?= $url ?>">修改密码</a>
    </li>
    <?php $url = url(['\Module\Account\Controller\User::modifyEmail']); ?>
    <li role="presentation" <?php if (strpos($url, $_SERVER['PATH_INFO'])) echo 'class="active"' ?>>
        <a href="<?= $url ?>">修改邮箱</a>
    </li>
    <?php $url = url(['\Module\Account\Controller\User::modifyMobile']); ?>
    <li role="presentation" <?php if (strpos($url, $_SERVER['PATH_INFO'])) echo 'class="active"' ?>>
        <a href="<?= $url ?>">修改手机</a>
    </li>
</ul>