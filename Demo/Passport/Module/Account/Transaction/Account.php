<?php

/**
 * Created by PhpStorm.
 * User: zjh
 * Date: 16/4/15
 * Time: 14:24
 */
namespace Module\Account\Transaction;

use Model\User as UserModel;
use Model\Uniqueid;
use Model\UserIndexUsername;
use Util;

class Account
{
    public static $errorMsg = '';

    public static function register($username, $password, $password2)
    {

        if (!$username || !$password || $password !== $password2) {
            self::$errorMsg = '参数错误';
            return 1;
        }

        $UserIndexUsernameModel = UserIndexUsername::instance();
        $exitUser = $UserIndexUsernameModel->get(['username' => $username]);
        if ($exitUser) {
            self::$errorMsg = '账号已经存在';
            return 2;
        }

        $UniqueidModel = Uniqueid::instance();
        $userId = $UniqueidModel->generate();
        $salt = Util::salt(8);
        $encodePassword = password_hash(Util::password($password, $salt), PASSWORD_DEFAULT);

        $UserModel = UserModel::instance();

        $UserModel->beginTransaction();

        $r = $UserModel->insert([
            'id' => $userId,
            'username' => $username,
            'password' => $encodePassword,
            'salt' => $salt,
            'regip' => ip2long(Util::clientIp()),
        ]);
        if (!$r) {
            self::$errorMsg = '注册失败';
            return 3;
        }

        $r = $UserIndexUsernameModel->insert([
            'username' => $username,
            'user_id' => $userId
        ]);
        if (!$r) {
            $UserModel->rollBack();
            self::$errorMsg = '注册失败';
            return 3;
        }
        $UserModel->commit();

        $_SESSION['user_id'] = $userId;
        $_SESSION['user_name'] = $username;
        $_SESSION['islogin'] = 1;

        return 0;
    }

    public static function login($username, $password)
    {
        if (!$username || !$password) {
            self::$errorMsg = '参数错误';
            return 1;
        }

        $UserIndexUsernameModel = UserIndexUsername::instance();
        $Index = $UserIndexUsernameModel->get(['username' => $username]);
        if (!$Index) {
            self::$errorMsg = '账号不存在';
            return 4;
        }
        $UserModel = UserModel::instance();
        $user = $UserModel->get(['id' => $Index['user_id']], '*');

        if (!$user) {
            self::$errorMsg = '参数错误';
            return 2;
        }

        if (!password_verify(Util::password($password, $user['salt']), $user['password'])) {
            self::$errorMsg = '参数错误';
            return 3;
        }

        $UserModel->update(['lastip' => ip2long(Util::clientIp())], ['id' => $user['id']]);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['username'];
        $_SESSION['islogin'] = 1;

        return 0;
    }
}