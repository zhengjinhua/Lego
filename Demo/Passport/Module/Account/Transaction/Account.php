<?php

/**
 * Created by PhpStorm.
 * User: zjh
 * Date: 16/4/15
 * Time: 14:24
 */
namespace Module\Account\Transaction;

use Model\Account as AccountModel;
use Model\Uniqueid;
use Model\AccountUsernameIndex;
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

        $AccountUsernameIndexModel = AccountUsernameIndex::instance();
        $exitAccount = $AccountUsernameIndexModel->get(['username' => $username]);
        if ($exitAccount) {
            self::$errorMsg = '账号已经存在';
            return 2;
        }

        $UniqueidModel = Uniqueid::instance();
        $accountId = $UniqueidModel->generate();
        $salt = Util::salt(8);
        $encodePassword = password_hash(Util::password($password, $salt), PASSWORD_DEFAULT);

        $AccountModel = AccountModel::instance();
        $AccountModel->setId($accountId);

        $AccountModel->beginTransaction();

        $r = $AccountModel->insert([
            'id' => $accountId,
            'username' => $username,
            'password' => $encodePassword,
            'salt' => $salt,
            'regip' => ip2long(Util::clientIp()),
        ]);
        if (!$r) {
            self::$errorMsg = '注册失败';
            return 3;
        }

        $r = $AccountUsernameIndexModel->insert([
            'username' => $username,
            'account_id' => $accountId
        ]);
        if (!$r) {
            $AccountModel->rollBack();
            self::$errorMsg = '注册失败';
            return 3;
        }
        $AccountModel->commit();

        $_SESSION['account_id'] = $accountId;
        $_SESSION['account_name'] = $username;
        $_SESSION['islogin'] = 1;

        return 0;
    }

    public static function login($username, $password)
    {
        if (!$username || !$password) {
            self::$errorMsg = '参数错误';
            return 1;
        }

        $AccountUsernameIndexModel = AccountUsernameIndex::instance();
        $Index = $AccountUsernameIndexModel->get(['username' => $username]);
        $AccountModel = AccountModel::instance();
        $AccountModel->setId($Index['account_id']);
        $account = $AccountModel->get(['id' => $Index['account_id']], '*');

        if (!$account) {
            self::$errorMsg = '参数错误';
            return 2;
        }

        if (!password_verify(Util::password($password, $account['salt']), $account['password'])) {
            self::$errorMsg = '参数错误';
            return 3;
        }

        $AccountModel->update(['lastip' => ip2long(Util::clientIp())], ['id' => $account['id']]);

        $_SESSION['account_id'] = $account['id'];
        $_SESSION['account_name'] = $account['username'];
        $_SESSION['islogin'] = 1;

        return 0;
    }
}