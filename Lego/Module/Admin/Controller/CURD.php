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

trait CURD
{
    public function index()
    {
        $this->beforeIndex();

        $where['ORDER'] = 'id DESC';
        !empty($_GET['keyword']) && $where['name'] = $_GET['keyword'];

        $pageGet = array_merge($_GET, ['page' => Page::placeholder]);
        $pageNum = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $Page = new Page($pageNum, 20);
        $Page->setUrl(url(['\\' . get_called_class() . '::index'], $pageGet));
        $list = $this->Model->pageList($Page, $where);

        $this->assign('list', $list);
        $this->assign('Page', $Page);
        $this->render(self::getClassName() . '/index');
    }

    public function add()
    {
        if (!empty($_POST)) {

            $this->beforeAdd($_POST);

            $result = $this->Model->insert($_POST['info']);
            if ($result) {
                Util::redirect(url(['\\' . get_called_class() . '::index']));
            } else {
                Util::showmessage("添加失败");
            }
        }

        $this->render(self::getClassName() . '/add');
    }

    public function update($id)
    {
        $info = $this->Model->get(['id' => $id]);
        if (!$info) {
            Util::showmessage("操作失败");
        }

        if (!empty($_POST)) {

            $this->beforeUpdate($_POST);

            $uid = $this->Model->updateOne($_POST['info'], ['id' => $info['id']]);
            if ($uid) {
                Util::redirect(url(['\\' . get_called_class() . '::index']));
            } else {
                Util::showmessage("操作失败");
            }
        }

        $this->assign('info', $info);
        $this->render(self::getClassName() . '/update');
    }

    public
    function delete($id)
    {
        $this->beforeDelete($id);

        $result = $this->Model->deleteOne(['id' => $id]);
        if ($result) {
            Util::redirect(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : url(['\\' . get_called_class() . '::index']));
        } else {
            Util::showmessage("删除失败");
        }
    }

    private
    static function getClassName()
    {
        $classPathArr = explode("\\", get_called_class());
        return array_pop($classPathArr);
    }

    private
    function beforeIndex()
    {
    }

    private
    function beforeAdd(&$post)
    {
    }

    private
    function beforeUpdate(&$post)
    {
    }

    private
    function beforeDelete($id)
    {
    }


}