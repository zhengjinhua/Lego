<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/2
 * Time: 18:18
 */

namespace Module\Admin\Controller;

use Page;
use Util;
use Controller\AdminBase;
use Module\Auth\Model\RoleModel;
use Module\Auth\Model\UserRoleModel;
use Module\Admin\Model\AdminUserModel;

/**
 * 用户管理
 * Class Index
 * @package Module\Admin\Controller
 */
class User extends AdminBase
{
    /**
     * @var \Module\Admin\Model\AdminUserModel
     */
    private $Model;
    private $UserRoleModel;
    private $RoleModel;

    public function __construct()
    {
        parent::__construct();

        $this->Model = AdminUserModel::instance();
        $this->UserRoleModel = UserRoleModel::instance();
        $this->RoleModel = RoleModel::instance();
    }

    /**
     * 列表
     */
    public function index()
    {
        $where['ORDER'] = 'id DESC';
        if (isset($_GET['dosubmit'])) {
            $where['username'] = trim($_GET['username']);
        }
        $pageNum = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $Page = new Page($pageNum, 20);
        $Page->setUrl(url(['\Module\Admin\Controller\User::index'], ['page' => Page::placeholder]));

        $lists = $this->Model->pageList($Page, $where);
        $roleIds = $roleName = [];
        $userRoles = $this->UserRoleModel->select([], ['user_id', 'role_id']);
        foreach ($userRoles as $v) {
            $roleIds[$v['user_id']] = $v['role_id'];
        }

        $roleList = $this->RoleModel->select([], ['id', 'name']);
        foreach ($roleList as $v) {
            $roleName[$v['id']] = $v['name'];
        }


        $this->assign('lists', $lists);
        $this->assign('Page', $Page);
        $this->assign('roleIds', $roleIds);
        $this->assign('roleName', $roleName);
        $this->render('User/index');
    }

    /**
     * 添加
     */
    public function add()
    {
        if (isset($_POST['dosubmit'])) {
            if (!$_POST['info']['username'] || !$_POST['info']['password']) {
                Util::showmessage("表单填写不完整");
            }
            if (!preg_match('/(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{6,20})$/', $_POST['info']['password'])) {
                Util::showmessage('密码必须要同时包含数字与字母 6-20位');
            }
            $_POST['info']['salt'] = Util::salt(8);
            $_POST['info']['password'] = Util::passwordX($_POST['info']['password'], $_POST['info']['salt']);
            $result = $this->Model->insert($_POST['info']);
            if ($result) {
                Util::redirect(url(['\Module\Admin\Controller\User::index']));
            } else {
                Util::showmessage("添加用户失败");
            }
        }

        $this->render('User/add');
    }

    /**
     * ajax检查username是否存在
     */
    public function ajaxUsername()
    {
        $username = isset($_GET['username']) && trim($_GET['username']) ? trim($_GET['username']) : exit(1);
        $res = $this->Model->get(['username' => $username]);
        if ($res) {
            exit('1');
        } else {
            exit('0');
        }
    }

    /**
     * 更新管理員信息
     *
     * @param int $id 账号id
     */
    public function update($id)
    {
        $adminUser = $this->Model->get(['id' => $id]);
        if (!$adminUser) {
            Util::redirect(url(['\Module\Admin\Controller\User::index']));
        }
        if (isset($_POST['dosubmit'])) {
            if (isset($_POST['info']['password']) && !empty($_POST['info']['password'])) {
                $_POST['info']['password'] = Util::passwordX($_POST['info']['password'], $adminUser['salt']);
            } else {
                unset($_POST['info']['password']);
            }

            $uid = $this->Model->update($_POST['info'], ['id' => $adminUser['id']]);
            if ($uid) {
                Util::redirect(url(['\Module\Admin\Controller\User::index']));
            }
        }

        $this->assign('adminUser', $adminUser);
        $this->render('User/update');
    }

    /**
     * 删除
     *
     * @param int $id
     */
    public function delete($id)
    {
        $result = $this->Model->delete(['id' => $id]);
        if ($result) {
            Util::redirect(url(['\Module\Admin\Controller\User::index']));
        } else {
            Util::showmessage("删除用户失败");
        }
    }
}