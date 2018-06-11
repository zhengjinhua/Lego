<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/4
 * Time: 15:46
 */

namespace Module\Admin\Controller;

use Util\Util;
use Module\Admin\Model\AdminUserModel;

class Home extends Base
{

    public function __construct()
    {
        parent::__construct();
        $this->adminUserModel = AdminUserModel::instance();
    }

    /**
     * 主页
     */
    public function index()
    {
        $this->render('Home/index');
    }

    /**
     * 修改密码
     */

    public function password()
    {
        $userid = $_SESSION['user']['id'];
        $user = $this->adminUserModel->get(['id' => $userid]);
        if ($_POST) {
            if (!$_POST['password'] || !$_POST['password_one']) {
                Util::showmessage("表单提交不完整！");
            }
            if (!preg_match('/(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{6,20})$/', $_POST['password_one'])) {
                Util::showmessage('密码必须要同时包含数字与字母 6-20位');
            }
            if (Util::passwordX($_POST['password'], $user['salt']) !== $user['password']) {
                Util::showmessage("请输入正确的密码！");
            }

            $password_one = Util::passwordX($_POST['password_one'], $user['salt']);
            $query = $this->adminUserModel->updateOne(['password' => $password_one], ['id' => $userid]);
            if ($query) {
                Util::redirect(url('/home'));
            } else {
                Util::showmessage("密码修改失败！");
            }

        }

        $this->render('Home/password');

    }

}