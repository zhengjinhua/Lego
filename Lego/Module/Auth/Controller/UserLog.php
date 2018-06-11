<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/30
 * Time: 9:24
 */

namespace Module\Auth\Controller;

use Util\Page;
use Module\Admin\Controller\Base;
use Module\Auth\Model\UserLogModel;

class UserLog extends Base
{

    private $userLogModel;

    public function __construct()
    {
        parent::__construct();
        $this->userLogModel = UserLogModel::instance();
    }

    public function index()
    {
        $where['ORDER'] = 'id DESC';
        !empty($_GET['keyword']) && $where['username'] = $_GET['keyword'];

        $pageGet = array_merge($_GET, ['page' => Page::placeholder]);
        $pageNum = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $page = new Page($pageNum, 20);
        $page->setUrl(url(['\Module\Auth\Controller\UserLog::index'], $pageGet));

        $list = $this->userLogModel->pageList($page, $where);

        $this->assign('list', $list);
        $this->assign('page', $page);
        $this->render('UserLog/index');
    }
}
