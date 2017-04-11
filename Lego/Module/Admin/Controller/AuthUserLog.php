<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/30
 * Time: 9:24
 */
namespace Module\Admin\Controller;

use Page;
use Controller\AdminBase;
use Module\Auth\Model\UserLogModel;

class AuthUserLog extends AdminBase
{

    private $UserLogModel;

    public function __construct()
    {
        parent::__construct();
        $this->UserLogModel = UserLogModel::instance();
    }

    public function index()
    {
        $where['ORDER'] = 'id DESC';
        if (isset($_GET['dosubmit'])) {
            $where['username'] = trim($_GET['username']);
        }
        $pageGet = array_merge($_GET, ['page' => Page::placeholder]);
        $pageNum = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $Page = new Page($pageNum, 15);
        $Page->setUrl(url(['\Module\Admin\Controller\AuthUserLog::index'], $pageGet));

        $lists = $this->UserLogModel->pageList($Page, $where);

        $this->assign('lists', $lists);
        $this->assign('Page', $Page);
        $this->render('AuthUserLog/index');
    }
}
