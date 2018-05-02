<?php
/**
 * Created by IntelliJ IDEA.
 * User: zjh
 * Date: 2018/5/2
 * Time: 20:49
 */
namespace Module\Demo\Controller;

use Module\Admin\Controller\Base;

class Index extends Base
{
    public function index($id){
        echo "id:$id";
    }
}