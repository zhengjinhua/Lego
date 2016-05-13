<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/24
 * Time: 15:25
 */

namespace Module\Account\Controller;

use Core\Controller;
use Core\Router;
use Module\Account\Model\User as UserModel;
use Util;

class User extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['islogin'])) {
            Util::redirect(Router::url(['\Module\Account\Controller\Index::login']));
        }
    }

    /**
     * 个人信息显示页面
     */
    public function index()
    {
        $UserModel = UserModel::instance();
        $user = $UserModel->get(['id' => $_SESSION['user_id']]);


        $this->assign('user', $user);
        $this->render('User/index');
    }

    /**
     * 修改密码
     */
    public function modifyPassword()
    {
        $this->render('User/modifyPassword');
    }

    /**
     * 修改邮箱
     */
    public function modifyEmail()
    {
        $this->render('User/modifyEmail');
    }

    /**
     * 修改手机
     */
    public function modifyMobile()
    {
        $this->render('User/modifyMobile');
    }

}