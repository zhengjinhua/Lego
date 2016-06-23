<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/20
 * Time: 9:20
 */

namespace Module\Auth\Controller;

use Controller\UserLoginedBase;
use Core\Router;
use Core\Config;
use Model\Action as ActionModel;
use Model\RoleAction as RoleActionModel;

class Action extends UserLoginedBase
{
    public function initDbX()
    {
        //应用所有接口
        $routerMap = Router::map();
        isset($routerMap['GET']) || $routerMap['GET'] = [];
        isset($routerMap['POST']) || $routerMap['POST'] = [];
        $routerMap['GET'] = array_filter($routerMap['GET'], function ($var) {
            return is_string($var);
        });
        $routerMap['POST'] = array_filter($routerMap['POST'], function ($var) {
            return is_string($var);
        });

        //排除接口
        $configAuthExcludedAction = Config::get('AUTH_EXCLUDED_ACTION');
        if ($configAuthExcludedAction) {
            isset($configAuthExcludedAction['GET']) || $configAuthExcludedAction['GET'] = [];
            isset($configAuthExcludedAction['POST']) || $configAuthExcludedAction['POST'] = [];

            $routerMap['GET'] = array_diff($routerMap['GET'], $configAuthExcludedAction['GET']);
            $routerMap['POST'] = array_diff($routerMap['POST'], $configAuthExcludedAction['POST']);
        }

        //数据库中接口列表
        $ActionModel = ActionModel::instance();
        $result = $ActionModel->select([], ['method', 'action']);
        $dbActionList = [];
        foreach ($result as $action) {
            $dbActionList[$action['method']][] = $action['action'];
        }
        unset($result);
        isset($dbActionList['GET']) || $dbActionList['GET'] = [];
        isset($dbActionList['POST']) || $dbActionList['POST'] = [];

        //取已经删除接口差集
        $getDeleteActions = array_diff($dbActionList['GET'], $routerMap['GET']);
        $postDeleteActions = array_diff($dbActionList['POST'], $routerMap['POST']);

        if ($getDeleteActions || $postDeleteActions) {
            $deleteCondition = [];
            foreach ($getDeleteActions as $action) {
                $deleteCondition['OR'][]['AND'] = ['method' => 'GET', 'action' => $action];
            }
            foreach ($postDeleteActions as $action) {
                $deleteCondition['OR'][]['AND'] = ['method' => 'POST', 'action' => $action];
            }
            $result = $ActionModel->select($deleteCondition, ['id']);
            $deleteIdArr = [];
            foreach ($result as $actionId) {
                $deleteIdArr[] = $actionId['id'];
            }
            unset($result);
            $ActionModel->delete(['id [IN]' => $deleteIdArr]);
            $RoleActionModel = RoleActionModel::instance();
            $RoleActionModel->delete(['action_id [IN]' => $deleteIdArr]);
        }

        //取新增接口差集
        $getInsertActions = array_diff($routerMap['GET'], $dbActionList['GET']);
        $postInsertActions = array_diff($routerMap['POST'], $dbActionList['POST']);

        if ($getInsertActions || $postInsertActions) {

            $isertData = [];
            foreach ($getInsertActions as $action) {
                $isertData[] = ['method' => 'GET', 'action' => $action];
            }
            foreach ($postInsertActions as $action) {
                $isertData[] = ['method' => 'POST', 'action' => $action];
            }
            $ActionModel->insert($isertData);
        }

        echo json_encode(['error' => 0, 'msg' => '更新完成'], JSON_UNESCAPED_UNICODE);
    }

    public function setNameX()
    {
        $id = intval($_POST['id']);
        $name = $_POST['name'];

        $ActionModel = ActionModel::instance();
        $result = $ActionModel->update(['name' => $name], ['id' => $id]);

        if ($result) {
            echo json_encode(['error' => 0, 'msg' => '更新完成'], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(['error' => 1, 'msg' => '更新失败'], JSON_UNESCAPED_UNICODE);
        }
    }
}