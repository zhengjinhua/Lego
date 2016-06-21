<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/24
 * Time: 15:25
 */

namespace Module\Account\Controller;

use Core\Controller;
use Util;
use Module\Account\Transaction\Account as AccountTransaction;

class Index extends Controller
{
    public function __construct()
    {
    }

    /**
     * 注册页面
     */
    public function reg()
    {
        if (isset($_SESSION['islogin'])) {
            Util::redirect(url(['\Module\Account\Controller\User::index']));
        }
        $this->render('Index/reg');
    }

    /**
     * 登陆页面
     */
    public function login()
    {
        if (isset($_SESSION['islogin'])) {
            Util::redirect(url(['\Module\Account\Controller\User::index']));
        }
        $this->render('Index/login');
    }

    public function logout()
    {
        if (!isset($_SESSION['islogin'])) {
            exit('Fail');
        }

        session_destroy();
        $result = [
            'r' => isset($_GET['r']) ? $_GET['r'] : url(['\Module\Account\Controller\Index::login'])
        ];

        $this->assign('result', $result);
        $this->render('Index/logout', 'empty');
    }

    public function regX()
    {
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $password2 = isset($_POST['password2']) ? $_POST['password2'] : '';

        //@todo 检查参数

        $r = AccountTransaction::register($username, $password, $password2);
        if ($r === 0) {
            $result = [
                'error' => 0,
                //'msg' => '注册成功',
                'r' => isset($_GET['r']) ? $_GET['r'] : url(['\Module\Account\Controller\User::index'])
            ];
        } else {
            $result = [
                'error' => $r,
                'msg' => AccountTransaction::$errorMsg,
            ];
        }

        echo json_encode($result);
    }

    /**
     * 登陆接口
     */
    public function loginX()
    {
        $username = isset($_POST['identify']) ? $_POST['identify'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        //@todo 检查参数

        $r = AccountTransaction::login($username, $password);
        if ($r === 0) {
            $result = [
                'error' => 0,
                //'msg' => '登陆成功',
                'r' => isset($_GET['r']) ? $_GET['r'] : url(['\Module\Account\Controller\User::index'])
            ];
        } else {
            $result = [
                'error' => $r,
                'msg' => AccountTransaction::$errorMsg,
            ];
        }

        echo json_encode($result);
    }
}
