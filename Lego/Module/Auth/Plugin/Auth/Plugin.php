<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/20
 * Time: 9:57
 */

namespace Module\Auth\Plugin\Auth;


use Util\Util;
use Core\Event;
use Core\Config;
use Core\PluginInterface;
use Module\Auth\Model\ActionModel;
use Module\Auth\Model\RoleActionModel;
use Module\Auth\Model\UserRoleModel;
use Module\Auth\Model\UserLogModel;

/**
 * 权限控制插件
 *
 * @package Module\Auth\Plugin\Auth
 */
class Plugin implements PluginInterface
{
    public static function register()
    {
        //登录时从数据库拉取用户权限
        Event::attach('APP.USER.LOGINED', function ($user) {
            $userRoleModel = UserRoleModel::instance();
            $roleActionModel = RoleActionModel::instance();
            $actionModel = ActionModel::instance();

            $userRoleIds = $roleActionIds = $roleActions = [];

            $result = $userRoleModel->select(['user_id' => $user['id']]);
            foreach ($result as $row) {
                $userRoleIds[] = $row['role_id'];
            }

            if ($userRoleIds) {
                $result = $roleActionModel->select(['role_id [IN]' => $userRoleIds]);
                foreach ($result as $row) {
                    $roleActionIds[] = $row['action_id'];
                }
            }

            if ($roleActionIds) {
                $result = $actionModel->select(['id [IN]' => $roleActionIds]);
                foreach ($result as $row) {
                    $roleActions[] = $row['action'];
                }
            }

            $_SESSION['auth'] = $roleActions;
        });

        //每次请求判断是否有权限
        Event::attach('CORE.ROUTE.POST', function ($callback) {

            if (!$callback) {
                return;
            }

            //开发环境
            if (\Util::clientIp() === '127.0.0.1') {
                return;
            }

            if (isset($_SESSION['user'])) {

                $pass = isset($_SESSION['auth']) &&
                    array_search($callback, $_SESSION['auth']) !== false;
                if (!$pass) {
                    if (Util::isAjax()) {
                        die('{"error":10001}');
                    } else {
                        Util::showmessage('您没有权限访问这个接口');
                    }
                } else {
                    //操作日志
                    $userLogModel = UserLogModel::instance();
                    $userLogModel->insert([
                        'user_id' => $_SESSION['user']['id'],
                        'username' => $_SESSION['user']['username'],
                        'method' => $_SERVER['REQUEST_METHOD'],
                        'pathinfo' => $_SERVER['PATH_INFO'],
                        'action' => $callback,
                        'param' => $_REQUEST ? json_encode($_REQUEST, JSON_UNESCAPED_UNICODE) : ''
                    ]);
                }
            }
        });

    }
}