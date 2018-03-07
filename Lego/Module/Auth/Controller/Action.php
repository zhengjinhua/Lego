<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/20
 * Time: 9:20
 */

namespace Module\Auth\Controller;

use Util;
use Core\Router;
use Core\Config;
use Module\Admin\Controller\Base;
use Module\Auth\Model\ActionModel;
use Module\Auth\Model\RoleActionModel;

class Action extends Base
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

    public function update($id)
    {
        $ActionModel = ActionModel::instance();
        $info = $ActionModel->get(['id' => $id]);
        if (!$info) {
            Util::showmessage("操作失败");
        }

        if (!empty($_POST)) {

            $uid = $ActionModel->updateOne($_POST['info'], ['id' => $info['id']]);
            if ($uid) {
                Util::redirect($_POST['back']);
            } else {
                Util::showmessage("操作失败");
            }
        }

        $this->assign('info', $info);
        $this->render('Action/update');
    }
}