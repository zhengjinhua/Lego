<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/24
 * Time: 15:25
 */

namespace Module\Account\Controller;

use Core\Controller;
use Model\Account;
use Util;

class User extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['islogin'])) {
            Util::redirect(Util::url(['\Module\Account\Controller\Index::login']));
        }
    }

    /**
     * 个人信息显示页面
     */
    public function index()
    {
        $AccountModel = Account::instance();
        $AccountModel->setId($_SESSION['account_id']);
        $account = $AccountModel->get(['id'=>$_SESSION['account_id']]);


        $this->assign('account',$account);
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