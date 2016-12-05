<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/13
 * Time: 14:41
 */

namespace Core;

/**
 * 控制器基类
 *
 * 集成的功能:接口静态化
 *
 * @package Core
 */
class Controller
{
    /**
     * @var string 当前请求的方法
     */
    public $action = '';

    /**
     * @var array 静态化方法列表
     */
    public $staticActionList = [];

    /**
     * @var string 主题
     */
    private $theme = '';

    /**
     * @var string 页面框架
     */
    private $layout = 'default';

    /**
     * @var array 页面变量
     */
    private $tplVar = [];

    /**
     * 执行当前请求的方法
     * @param $action
     * @param $args
     * @throws \Exception
     */
    final public function run($action, $args)
    {
        $this->action = $action;
        if (!method_exists($this, $action) && !is_callable(array($this, $action))) {
            throw new \Exception("{$action} ACTION NOT FIND", 606);
        }
        //运行接口
        Event::raise('CORE.ACTION.RUN.PRE', $this);
        call_user_func_array(array($this, $action), $args);
        Event::raise('CORE.ACTION.RUN.POST', $this);
    }

    /**
     * 设置主题目录
     * @param string $dirName
     */
    final protected function setTheme($dirName)
    {
        $this->theme = $dirName;
    }

    /**
     * 设置框架文件名
     * @param string $fileName
     */
    final protected function setLayout($fileName)
    {
        $this->layout = $fileName;
    }

    /**
     * 传递变量给模版
     * @param string $name
     * @param mixed $val
     */
    final protected function assign($name, $val)
    {
        if (is_array($name)) {
            $this->tplVar = array_merge($this->tplVar, $name);
        } else {
            $this->tplVar[$name] = $val;
        }
    }

    /**
     * 渲染模版
     *
     * 视图文件查找路径:主题下的视图->模块下的视图
     * 框架文件查找路径:主题下的框架->模块下的框架->公用的框架
     * @param string $view
     * @param string $layout
     * @throws \Exception
     */
    final protected function render($view, $layout = null)
    {
        if ($layout !== null) {
            $this->layout = $layout;
        }

        $viewFile = $layoutFile = '';

        $calledClassPath = explode('\\', get_called_class());

        //查找主题下的视图文件和框架文件
        if ($this->theme) {
            $moduleName = implode('/', array_slice($calledClassPath, 1, -2));
            $viewFile = APP_PATH . '/View/' . $this->theme . '/' . $moduleName . '/' . $view . '.php';
            $layoutFile = APP_PATH . '/View/' . $this->theme . '/Layout/' . $this->layout . '.php';
        }

        //获取模块视图路径
        $moduleViewPath = APP_PATH . '/' . implode('/', array_slice($calledClassPath, 0, -2)) . '/' . 'View';

        //查找模块下的视图文件
        if (!$viewFile || !is_file($viewFile)) {
            $viewFile = $moduleViewPath . '/' . $view . '.php';
        }

        //查找模块下的框架文件
        if (!$layoutFile || !is_file($layoutFile)) {
            $layoutFile = $moduleViewPath . '/Layout/' . $this->layout . '.php';
        }
        //查找公用的框架文件
        if (!$layoutFile || !is_file($layoutFile)) {
            $layoutFile = APP_PATH . '/View/Layout/' . $this->layout . '.php';
        }

        if (!is_file($viewFile)) {
            throw new \Exception("{$viewFile} VIEW NOT FIND", 607);
        }
        if (!is_file($layoutFile)) {
            throw new \Exception("{$this->layout} LAYOUT NOT FIND", 608);
        }

        Event::raise('CORE.VIEW.RENDER.PRE', $this);

        extract($this->tplVar);
        ob_start();
        require $viewFile;
        $content = ob_get_clean();
        require $layoutFile;

        Event::raise('CORE.VIEW.RENDER.POST', $this);
    }
} 