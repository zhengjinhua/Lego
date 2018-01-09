<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/20
 * Time: 9:20
 */

namespace Module\Auth\Controller;

use Util;
use Module\Admin\Controller\Base;
use Module\Auth\Model\RoleModel;
use Module\Auth\Model\ActionModel;
use Module\Auth\Model\RoleActionModel;
use Module\Admin\Model\AdminUserModel;
use Module\Auth\Model\UserRoleModel;

class Auth extends Base
{
    /**
     * 角色授权页面
     *
     * @param $id
     * @throws \Exception
     */
    public function action($id)
    {
        $RoleModel = RoleModel::instance();
        $role = $RoleModel->get(['id' => $id]);
        if (!$role) {
            Util::showmessage("角色不存在");
        }

        $RoleActionModel = RoleActionModel::instance();
        $result = $RoleActionModel->select(['role_id' => $id], ['action_id']);
        $roleActions = [];
        foreach ($result as $row) {
            $roleActions[] = $row['action_id'];
        }
        unset($result);

        $ActionModel = ActionModel::instance();
        $actions = $ActionModel->select(['ORDER' => 'class,action'], ['id', 'action', 'class', 'name']);
        $actionGroups = [];
        foreach ($actions as $act) {
            $actionGroups[$act['class']][] = $act;
        }
        $this->assign('role', $role);
        $this->assign('roleActions', $roleActions);
        //$this->assign('actions', $actions);
        $this->assign('actionGroups', $actionGroups);

        $this->render('Auth/action');
    }

    /**
     * 角色授权接口
     */
    public function actionAuthX()
    {
        $roleId = intval($_POST['roleId']);
        $actionId = intval($_POST['actionId']);

        if ($roleId || $actionId) {
            $data = ['role_id' => $roleId, 'action_id' => $actionId];
            $RoleActionModel = RoleActionModel::instance();
            $count = $RoleActionModel->column(['COUNT(1)'], $data);
            if ($count) {
                $result = $RoleActionModel->delete($data);
            } else {
                $result = $RoleActionModel->insert($data);
            }
            if ($result) {
                echo json_encode(['error' => 0, 'msg' => '操作成功'], JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(['error' => 1, 'msg' => '操作失败'], JSON_UNESCAPED_UNICODE);
            }
        } else {
            echo json_encode(['error' => 1, 'msg' => '操作失败'], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * 用户授权页面
     * @param $id
     * @throws \Exception
     */
    public function user($id)
    {
        $AdminUserModel = AdminUserModel::instance();
        $user = $AdminUserModel->get(['id' => $id]);
        if (!$user) {
            Util::showmessage("用户不存在");
        }

        $UserRoleModel = UserRoleModel::instance();
        $result = $UserRoleModel->select(['user_id' => $id], ['role_id']);
        $userRoles = [];
        foreach ($result as $row) {
            $userRoles[] = $row['role_id'];
        }
        unset($result);

        $RoleModel = RoleModel::instance();
        $roles = $RoleModel->select([], ['id', 'name']);

        $this->assign('user', $user);
        $this->assign('roles', $roles);
        $this->assign('userRoles', $userRoles);

        $this->render('Auth/user');
    }

    /**
     * 用户授权接口
     */
    public function userAuthX()
    {
        $userId = intval($_POST['userId']);
        $roleId = intval($_POST['roleId']);

        if ($userId || $roleId) {
            $data = ['user_id' => $userId, 'role_id' => $roleId];
            $UserRoleModel = UserRoleModel::instance();
            $count = $UserRoleModel->column(['COUNT(1)'], $data);
            if ($count) {
                $result = $UserRoleModel->delete($data);
            } else {
                $result = $UserRoleModel->insert($data);
            }
            if ($result) {
                echo json_encode(['error' => 0, 'msg' => '操作成功'], JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(['error' => 1, 'msg' => '操作失败'], JSON_UNESCAPED_UNICODE);
            }
        } else {
            echo json_encode(['error' => 1, 'msg' => '操作失败'], JSON_UNESCAPED_UNICODE);
        }
    }
}