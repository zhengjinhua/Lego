<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/4
 * Time: 15:46
 */

namespace Module\Account\Controller;

use Controller\UserLoginedBase;

class Home extends UserLoginedBase
{
    /**
     * 主页
     */
    public function index()
    {
        $this->render('Home/index');
    }

}