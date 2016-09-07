<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/2
 * Time: 18:18
 */

namespace Module\Account\Controller;

use Controller\UserLoginedBase;
use Model\User as UserModel;
use Page;
use Util;

/**
 * 用户管理
 * Class Index
 * @package Module\Account\Controller
 */
class User extends UserLoginedBase
{
    /**
     * @var \Model\User
     */
    private $Model;

    public function __construct()
    {
        parent::__construct();

        $this->Model = UserModel::instance();
    }

    /**
     * 列表
     */
    public function index()
    {
        $pageNum = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $Page = new Page($pageNum, 10);
        $Page->setUrl(url(['\Module\Account\Controller\User::index'], ['page' => Page::placeholder]));

        $list = $this->Model->pageList($Page);
        $this->assign('list', $list);
        $this->assign('Page', $Page);

        $this->render('User/index');
    }

    /**
     * 添加
     */
    public function add()
    {
        if ($_POST) {
            if (!$_POST['username'] || !$_POST['password']) {
                Util::showmessage("表单填写不完整");
            }
            $data['username'] = $_POST['username'];
            $data['nickname'] = $_POST['nickname'];
            $data['email'] = $_POST['email'];
            $data['status'] = $_POST['status'];
            $data['createtime'] = 'now()';
            $data['salt'] = Util::salt(8);
            $data['password'] = Util::password($_POST['password'], $data['salt']);
            $result = $this->Model->insert($data);
            if ($result) {
                Util::redirect(url(['\Module\Account\Controller\User::index']));
            } else {
                Util::showmessage("添加用户失败");
            }
        }

        $this->render('User/add');
    }

    /**
     * 更新
     *
     * @param int $id
     */
    public function update($id)
    {
        $user = $this->Model->get(['id' => $id]);
        if (!$user) {
            Util::showmessage("用户不存在");
        }
        if ($_POST) {
            $data['nickname'] = $_POST['nickname'];
            $data['email'] = $_POST['email'];
            $data['status'] = $_POST['status'];
            if ($_POST['password']) {
                $data['password'] = Util::password($_POST['password'], $user['salt']);
            }
            $result = $this->Model->update($data, ['id' => $id]);
            if ($result) {
                Util::redirect(url(['\Module\Account\Controller\User::index']));
            } else {
                Util::showmessage("更新用户失败");
            }
        } else {
            $this->assign('user', $user);
            $this->render('User/update');
        }
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
            Util::redirect(url(['\Module\Account\Controller\User::index']));
        } else {
            Util::showmessage("删除用户失败");
        }
    }
}