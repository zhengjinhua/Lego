<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/4
 * Time: 13:19
 */

namespace Module\Admin\Controller;

use Util;
use Core\Event;
use Core\Controller;
use Module\Admin\Model\AdminUserModel;

class Index extends Controller
{
    public function __construct()
    {
        $this->setLayout('empty');
    }

    public function index()
    {
        //检查是否登录
        if (isset($_SESSION['user'])) {
            Util::redirect(url('/home'));
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
            $result['msg'] = '页面已过期';
        } else {
            $username = isset($_POST['username']) ? $_POST['username'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $checkcode = isset($_POST['checkcode']) ? $_POST['checkcode'] : '';
            $captcha = $_SESSION['captcha'];
            if (!$username || !$password || !$checkcode || !$captcha) {
                $result['code'] = 3;
                $result['msg'] = '帐号或密码错误';
            } else {
                if ($captcha != strtolower($checkcode)) {
                    $result['code'] = 4;
                    $result['msg'] = '验证码错误';
                } else {

                    $adminUserModel = AdminUserModel::instance();
                    $user = $adminUserModel->get(['username' => $username]);
                    if (!$user) {
                        $result['code'] = 5;
                        $result['msg'] = '帐号或密码错误';
                    } else {
                        if (Util::passwordX($password, $user['salt']) === $user['password'] && $user['loginerrtimes'] <= 3) {
                            //密码失败最多尝试次数3次，大于3次锁定用户
                            $data['lastip'] = Util::clientIp();
                            $data['lasttime'] = time();
                            $data['loginerrtimes'] = 0;
                            $adminUserModel->updateOne($data, ['id' => $user['id']]);
                            $_SESSION['user'] = $user;

                            Event::raise('APP.USER.LOGINED', $user);

                            $result['code'] = 0;
                            $result['msg'] = '';

                        } else {
                            $restTimes = $user['loginerrtimes'] + 1;

                            $failedTimes = 3 - $restTimes;
                            $result['code'] = 6;
                            $result['msg'] = 'Password error,剩余尝试次数' . $failedTimes . '次!';

                            $adminUserModel->updateOne(['loginerrtimes' => $restTimes], ['id' => $user['id']]);
                            if ($user['loginerrtimes'] >= 3) {
                                $result['code'] = 7;
                                $result['msg'] = '账户被锁定，请联系管理员!';
                                echo json_encode($result);
                                return false;
                            }

                        }
                    }
                }
            }
        }

        echo json_encode($result);
    }

    public function logout()
    {
        session_destroy();
        Util::redirect('/');
    }

}