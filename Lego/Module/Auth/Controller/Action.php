<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/20
 * Time: 9:20
 */

namespace Module\Auth\Controller;

use Core\Router;
use Core\Config;
use Controller\AdminBase;
use Module\Auth\Model\ActionModel;
use Module\Auth\Model\RoleActionModel;

class Action extends AdminBase
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
        $routerMap = array_unique(array_merge($routerMap['GET'], $routerMap['POST']));

        //排除接口
        $configAuthExcludedAction = Config::get('AUTH_EXCLUDED_ACTION');
        if ($configAuthExcludedAction) {
            $routerMap = array_diff($routerMap, $configAuthExcludedAction);
        }

        //数据库中接口列表
        $ActionModel = ActionModel::instance();
        $result = $ActionModel->select([], ['action']);
        $dbActionList = [];
        foreach ($result as $action) {
            $dbActionList[] = $action['action'];
        }
        unset($result);

        //取已经删除接口差集
        $deleteActions = array_diff($dbActionList, $routerMap);
        if ($deleteActions) {
            $deleteCondition['action [IN]'] = $deleteActions;
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
        $insertActions = array_diff($routerMap, $dbActionList);
        if ($insertActions) {
            $isertData = [];
            foreach ($insertActions as $action) {
                $isertData[] = ['action' => $action];
            }
            $ActionModel->insert($isertData);
        }

        echo json_encode(['error' => 0, 'msg' => '更新完成'], JSON_UNESCAPED_UNICODE);
    }

    public function setNameX()
    {
        $id = intval($_POST['id']);
        $class = $_POST['class'];
        $name = $_POST['name'];

        $ActionModel = ActionModel::instance();
        $result = $ActionModel->updateOne(['class' => $class, 'name' => $name], ['id' => $id]);

        if ($result) {
            echo json_encode(['error' => 0, 'msg' => '更新完成'], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(['error' => 1, 'msg' => '更新失败'], JSON_UNESCAPED_UNICODE);
        }
    }
}