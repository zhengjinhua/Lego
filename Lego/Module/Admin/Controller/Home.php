<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/4
 * Time: 15:46
 */

namespace Module\Admin\Controller;

use Util;
use Controller\AdminBase;
use Module\Admin\Model\AdminUserModel;

class Home extends AdminBase
{

    public function __construct()
    {
        parent::__construct();
        $this->AdminUserModel = AdminUserModel::instance();
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
        $user = $this->AdminUserModel->get(['id' => $userid]);
        if ($_POST) {
            if (!$_POST['password'] && !$_POST['password_one'] && !$_POST['password_two']) {
                Util::redirect(url('/home'));
            } else {
                if (!$_POST['password'] || !$_POST['password_one'] || !$_POST['password_two']) {
                    Util::showmessage("表单提交不完整！");
                }
                if (!preg_match('/(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{6,20})$/', $_POST['password_one'])) {
                    Util::showmessage('密码必须要同时包含数字与字母 6-20位');
                }
                if ($_POST['password_one'] != $_POST['password_two']) {
                    Util::showmessage("两次密码输入不一致！");
                }
                if (Util::passwordX($_POST['password'], $user['salt']) !== $user['password']) {
                    Util::showmessage("请输入正确的密码！");
                }

                $password_one = Util::passwordX($_POST['password_one'], $user['salt']);
                $query = $this->AdminUserModel->update(['password' => $password_one], ['id' => $userid]);
                if ($query) {
                    Util::redirect(url('/home'));
                } else {
                    Util::showmessage("密码修改失败！");
                }
            }

        }

        $this->render('Home/password');

    }

    /**
     * 修改个人信息
     */
    public function memberInfo()
    {
        $userid = $_SESSION['user']['id'];
        $user = $this->AdminUserModel->get(['id' => $userid]);
        if ($_POST) {
            if (!$_POST['nickname'] || !$_POST['email']) {
                Util::showmessage("表单提交不完整！");
            }
            //$data['realname'] = iconv('utf-8', 'gbk', trim($_POST['realname']));
            $data['email'] = trim($_POST['email']);
            $data['nickname'] = trim($_POST['nickname']);
            $query = $this->AdminUserModel->update($data, ['id' => $userid]);
            if ($query) {
                Util::redirect(url('/home'));
            } else {
                Util::showmessage("修改失败！");
            }

        }
        $this->assign('user', $user);
        $this->render('Home/memberInfo');
    }

    /**
     * ajax验证用户密码
     */
    public function passwordAjax()
    {
        $userid = $_SESSION['user']['id'];
        $user = $this->AdminUserModel->get(['id' => $userid]);
        $old_password = trim($_GET['old_password']);
        if (Util::passwordX($old_password, $user['salt']) === $user['password']) {
            exit('1');
        }
        exit('0');
    }

    /**
     * ajax验证用户Email
     */
    public function emailAjax()
    {
        $email = trim($_GET['email']);
        if ($this->AdminUserModel->get(['email' => $email], ['id'])) {
            exit('0');
        }
        exit('1');
    }
}