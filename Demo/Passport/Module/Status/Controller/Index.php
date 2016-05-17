<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/11
 * Time: 19:39
 */

namespace Module\Status\Controller;

use Core\Config;
use Core\Controller;
use Core\Event;
use Core\Extension;
use Core\Router;

class Index extends Controller
{
    public function index()
    {
        $this->assign('pluginList', Extension::getPluginList());
        $this->assign('moduleList', Extension::getModuleList());
        $this->assign('routerMap', Router::map());
        $this->assign('eventMap', Event::map());
        $this->assign('config', Config::get());
        $this->render('Index/index');
    }
}