<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/29
 * Time: 16:40
 */
namespace Module\ModuleName\Controller;

use Page;
use Util;
use Controller\AdminBase;
use Model\ModelNameModel;

class ControllerName extends AdminBase
{

    private $attributeModel;

    public function __construct()
    {
        parent::__construct();
        $this->attributeModel = ModelName::instance();
    }

    public function index()
    {
        $where['ORDER'] = 'id DESC';
        if (isset($_GET['dosubmit'])) {
            //if (!empty($_GET['name'])) $where['name[LIKE]'] = trim($_GET['name']);
            //if (!empty($_GET['starttime'])) $where['createtime[>=]'] = trim($_GET['starttime']);
            //if (!empty($_GET['endtime'])) $where['createtime[<=]'] = trim($_GET['endtime']);
        }

        $pageGet = array_merge($_GET, ['page' => Page::placeholder]);
        $pageNum = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $Page = new Page($pageNum, 15);
        $Page->setUrl(url(['\Module\ModuleName\Controller\ControllerName::index'], $pageGet));
        $lists = $this->attributeModel->pageList($Page, $where);

        $this->assign('Page', $Page);
        $this->assign('lists', $lists);
        $this->render('ControllerName/index');
    }

    public function delete($id)
    {
        $attribute = $this->findOne($id);
        $did = $this->attributeModel->delete(['id' => $id]);
        if ($did) {
            Util::redirect(url(['\Module\ModuleName\Controller\ControllerName::index']));
        }
    }

    public function add()
    {
        if (isset($_POST['dosubmit'])) {
            $id = $this->attributeModel->insert($_POST['info']);
            if ($id) {
                Util::redirect(url(['\Module\ModuleName\Controller\ControllerName::index']));
            }
        }

        $this->render('ControllerName/add');
    }

    public function modify($id)
    {
        $attribute = $this->findOne($id);
        if (isset($_POST['dosubmit'])) {
            $uid = $this->attributeModel->update($_POST['info'], ['id' => $id]);
            if ($uid) {
                Util::redirect(url(['\Module\ModuleName\Controller\ControllerName::index']));
            }
        }

        $this->assign('attribute', $attribute);
        $this->render('ControllerName/modify');
    }

    private function findOne($id)
    {
        $attribute = $this->attributeModel->get(['id' => $id]);
        if (!$attribute) {
            Util::showmessage('非法ID');
        }
        return $attribute;
    }
}
