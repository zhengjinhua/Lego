<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/30
 * Time: 9:24
 */

namespace Module\Auth\Controller;

use Page;
use Module\Admin\Controller\Base;
use Module\Auth\Model\UserLogModel;

class UserLog extends Base
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
        !empty($_GET['keyword']) && $where['username'] = trim($_GET['keyword']);

        $pageGet = array_merge($_GET, ['page' => Page::placeholder]);
        $pageNum = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $Page = new Page($pageNum, 20);
        $Page->setUrl(url(['\Module\Auth\Controller\UserLog::index'], $pageGet));

        $list = $this->UserLogModel->pageList($Page, $where);

        $this->assign('list', $list);
        $this->assign('Page', $Page);
        $this->render('UserLog/index');
    }
}
