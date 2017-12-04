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
use Module\Auth\Model\RoleModel;
use Module\Auth\Model\UserRoleModel;
use Module\Admin\Model\AdminUserModel;

/**
 * 用户管理
 * Class Index
 * @package Module\Admin\Controller
 */
class User extends Base
{

    use CURD;

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
        !empty($_GET['keyword']) && $where['username'] = trim($_GET['keyword']);

        if (!empty($_GET['role_id'])) {
            $roleUsers = $this->UserRoleModel->select(['role_id' => $_GET['role_id']], ['user_id'], 'user_id');
            $ids = array_keys($roleUsers);
            $where['id [IN]'] = $ids ? $ids : [0];
        }

        $pageGet = array_merge($_GET, ['page' => Page::placeholder]);
        $pageNum = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $Page = new Page($pageNum, 20);
        $Page->setUrl(url(['\Module\Admin\Controller\User::index'], $pageGet));
        $list = $this->Model->pageList($Page, $where);

        $roleIds = $roleName = [];
        $userRoles = $this->UserRoleModel->select([], ['user_id', 'role_id']);
        foreach ($userRoles as $v) {
            $roleIds[$v['user_id']] = $v['role_id'];
        }

        $roleList = $this->RoleModel->select([], ['id', 'name']);
        foreach ($roleList as $v) {
            $roleName[$v['id']] = $v['name'];
        }

        $this->assign('list', $list);
        $this->assign('Page', $Page);
        $this->assign('roleIds', $roleIds);
        $this->assign('roleName', $roleName);
        $this->render('User/index');
    }

    private function beforeAdd(&$post)
    {
        if (!$post['info']['username'] || !$post['info']['password']) {
            Util::showmessage("表单填写不完整");
        }

        $post['info']['salt'] = Util::salt(8);
        $post['info']['password'] = Util::passwordX($post['info']['password'], $post['info']['salt']);
    }

    private function beforeUpdate(&$post)
    {
        if (isset($post['info']['password']) && !empty($post['info']['password'])) {
            $post['info']['salt'] = Util::salt(8);
            $post['info']['password'] = Util::passwordX($post['info']['password'], $post['info']['salt']);
        } else {
            unset($post['info']['password']);
        }
    }

}