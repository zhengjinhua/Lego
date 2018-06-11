<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/2
 * Time: 18:18
 */

namespace Module\Admin\Controller;

use Util\Page;
use Util\Util;
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
    private $model;
    private $userRoleModel;
    private $roleModel;

    public function __construct()
    {
        parent::__construct();

        $this->model = AdminUserModel::instance();
        $this->userRoleModel = UserRoleModel::instance();
        $this->roleModel = RoleModel::instance();
    }

    /**
     * 列表
     */
    public function index()
    {
        $where['ORDER'] = 'id DESC';
        !empty($_GET['keyword']) && $where['username'] = $_GET['keyword'];

        if (!empty($_GET['role_id'])) {
            $roleUsers = $this->userRoleModel->select(['role_id' => $_GET['role_id']], ['user_id'], 'user_id');
            $ids = array_keys($roleUsers);
            $where['id [IN]'] = $ids ? $ids : [0];
        }

        $pageGet = array_merge($_GET, ['page' => Page::placeholder]);
        $pageNum = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $page = new Page($pageNum, 20);
        $page->setUrl(url(['\Module\Admin\Controller\User::index'], $pageGet));
        $list = $this->model->pageList($page, $where);

        $roleIds = $roleName = [];
        $userRoles = $this->userRoleModel->select([], ['user_id', 'role_id']);
        foreach ($userRoles as $v) {
            $roleIds[$v['user_id']] = $v['role_id'];
        }

        $roleList = $this->roleModel->select([], ['id', 'name']);
        foreach ($roleList as $v) {
            $roleName[$v['id']] = $v['name'];
        }

        $this->assign('list', $list);
        $this->assign('page', $page);
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