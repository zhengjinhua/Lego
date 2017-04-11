<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/20
 * Time: 9:57
 */

namespace Module\Auth\Plugin\Auth;


use Util;
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
 * 权限控制排除接口配置
 * Config::set('AUTH_EXCLUDED_ACTION', []]);
 *
 * @package Module\Auth\Plugin\Auth
 */
class Plugin implements PluginInterface
{
    public static function register()
    {
        //登录时从数据库拉取用户权限
        Event::attach('APP.USER.LOGINED', function ($user) {
            $UserRoleModel = UserRoleModel::instance();
            $RoleActionModel = RoleActionModel::instance();
            $ActionModel = ActionModel::instance();

            $userRoleIds = $roleActionIds = $roleActions = [];

            $result = $UserRoleModel->select(['user_id' => $user['id']]);
            foreach ($result as $row) {
                $userRoleIds[] = $row['role_id'];
            }

            if ($userRoleIds) {
                $result = $RoleActionModel->select(['role_id [IN]' => $userRoleIds]);
                foreach ($result as $row) {
                    $roleActionIds[] = $row['action_id'];
                }
            }

            if ($roleActionIds) {
                $result = $ActionModel->select(['id [IN]' => $roleActionIds]);
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

            if (isset($_SESSION['user'])) {
                //排除接口
                $configAuthExcludedAction = Config::get('AUTH_EXCLUDED_ACTION');
                if ($configAuthExcludedAction &&
                    array_search($callback, $configAuthExcludedAction) !== false
                ) {
                    return;
                }

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
                    $UserLogModel = UserLogModel::instance();
                    $UserLogModel->insert([
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