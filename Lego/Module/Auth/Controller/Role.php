<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/20
 * Time: 9:20
 */

namespace Module\Auth\Controller;

use Page;
use Util;
use Controller\AdminBase;
use Module\Auth\Model\RoleModel;
use Module\Auth\Model\UserRoleModel;
use Module\Auth\Model\RoleActionModel;

class Role extends AdminBase
{
    /**
     * @var \Module\Auth\Model\Role
     */
    private $Model;

    public function __construct()
    {
        parent::__construct();

        $this->Model = RoleModel::instance();
    }

    /**
     * 角色列表
     */
    public function index()
    {
        $pageNum = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $Page = new Page($pageNum, 20);
        $Page->setUrl(url(['\Module\Auth\Controller\Role::index'], ['page' => Page::placeholder]));
        $where['ORDER'] = 'id DESC';
        if (isset($_GET['name'])) {
            $where = ['name' => $_GET['name']];
        }
        $list = $this->Model->pageList($Page, $where);

        $this->assign('list', $list);
        $this->assign('Page', $Page);

        $this->render('Role/index');
    }

    /**
     * 添加角色
     * @throws \Exception
     */
    public function add()
    {
        if ($_POST) {
            $data['name'] = $_POST['name'];
            $result = $this->Model->insert($data);
            if ($result) {
                Util::redirect(url(['\Module\Auth\Controller\Role::index']));
            } else {
                Util::showmessage("添加失败");
            }
        }
        $this->render('Role/add');
    }

    /**
     * 更新角色
     * @param $id
     * @throws \Exception
     */
    public function update($id)
    {
        $role = $this->Model->get(['id' => $id]);
        if (!$role) {
            Util::showmessage("角色不存在");
        }
        if ($_POST) {
            $data['name'] = $_POST['name'];
            $result = $this->Model->update($data, ['id' => $id]);
            if ($result) {
                Util::redirect(url(['\Module\Auth\Controller\Role::index']));
            } else {
                Util::showmessage("更新失败");
            }
        }
        $this->assign('role', $role);
        $this->render('Role/update');
    }

    /**
     * @param $id 删除角色
     */
    public function delete($id)
    {
        $result = $this->Model->delete(['id' => $id]);
        if ($result) {

            $RoleActionModel = RoleActionModel::instance();
            $RoleActionModel->delete(['role_id' => $id]);

            $UserRoleModel = UserRoleModel::instance();
            $UserRoleModel->delete(['role_id' => $id]);

            Util::redirect(url(['\Module\Auth\Controller\Role::index']));
        } else {
            Util::showmessage("删除失败");
        }
    }
}