<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/20
 * Time: 9:20
 */

namespace Module\Auth\Controller;

use Controller\UserLoginedBase;
use Model\Role as RoleModel;
use Model\User as UserModel;
use Page;
use Util;

class Role extends UserLoginedBase
{
    /**
     * @var \Model\Role
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
        $where = [];
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
            Util::redirect(url(['\Module\Auth\Controller\Role::index']));
        } else {
            Util::showmessage("删除失败");
        }
    }
}