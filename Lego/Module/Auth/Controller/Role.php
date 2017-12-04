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
use Module\Admin\Controller\CURD;
use Module\Auth\Model\RoleModel;
use Module\Auth\Model\UserRoleModel;
use Module\Auth\Model\RoleActionModel;

class Role extends Base
{

    use CURD;
    /**
     * @var \Module\Auth\Model\Role
     */
    private $Model;
    private $UserRoleModel;

    public function __construct()
    {
        parent::__construct();

        $this->Model = RoleModel::instance();
    }

    /**
     * @param $id 删除角色
     */
    public function delete($id)
    {
        $result = $this->Model->deleteOne(['id' => $id]);
        if ($result) {

            $RoleActionModel = RoleActionModel::instance();
            $RoleActionModel->delete(['role_id' => $id]);

            $UserRoleModel = UserRoleModel::instance();
            $UserRoleModel->delete(['role_id' => $id]);
            Util::redirect(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : url(['\Module\Auth\Controller\Role::index']));
        } else {
            Util::showmessage("操作失败");
        }
    }

    private function beforeIndex()
    {
        $this->UserRoleModel = UserRoleModel::instance();
        $roleCount = $this->UserRoleModel->select(['GROUP' => 'role_id'], ['COUNT(1) as cnt', 'role_id'], 'role_id');
        $this->assign('roleCount', $roleCount);
    }
}