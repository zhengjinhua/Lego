<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/4
 * Time: 13:19
 */

namespace Module\Account\Controller;

use Core\Controller;
use Model\User;
use Util;

class Index extends Controller
{
    public function __construct()
    {
        $this->setLayout('empty');
    }

    public function index()
    {
        //检查是否登录
        if (isset($_SESSION['login'])) {
            Util::redirect(url(['\Module\Account\Controller\Home::index']));
        }

        Util::setToken();
        $this->render('Index/index');
    }

    public function login()
    {
        $result = [];
        //检查token
        if (!Util::verifyToken()) {
            $result['code'] = 2;
            $result['msg'] = 'token error';
        } else {
            $username = isset($_POST['username']) ? trim($_POST['username']) : '';
            $password = isset($_POST['password']) ? trim($_POST['password']) : '';

            if (!$username || !$password) {
                $result['code'] = 3;
                $result['msg'] = 'input error';
            } else {
                $UserModel = User::instance();
                $user = $UserModel->get(['username' => $username]);
                if (!$user) {
                    $result['code'] = 4;
                    $result['msg'] = 'input error';
                } else {
                    if (Util::password($password, $user['salt']) === $user['password']) {
                        $_SESSION['login'] = 1;
                        $_SESSION['user'] = $user;

                        $result['code'] = 0;
                        $result['msg'] = '';
                    } else {
                        $result['code'] = 5;
                        $result['msg'] = 'input error';
                    }
                }
            }
        }

        echo json_encode($result);
    }

    public function logout()
    {
        session_destroy();
        Util::redirect(url(['\Module\Account\Controller\Index::index']));
    }

}