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
 * @package Core
 */
class Controller
{
    /**
     * @var string 当前请求的方法
     */
    public $action = '';

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
    final protected function assign($name, $val = null)
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
     */
    final protected function render($view, $layout = null)
    {
        $viewFile = $layoutFile = '';

        if ($layout !== null) {
            $this->layout = $layout;
        }

        $calledClassPath = explode('\\', get_called_class());
        $moduleName = implode('/', array_slice($calledClassPath, 1, -2));

        // STEP: I 查找APP模块下的视图文件和框架文件
        $appModuleViewPath = APP_PATH . '/Module/' . $moduleName . '/' . 'View';
        if (is_dir($appModuleViewPath)) {
            if (!$viewFile || !is_file($viewFile)) {
                $viewFile = $appModuleViewPath . '/' . $view . '.php';
            }
            if (!$layoutFile || !is_file($layoutFile)) {
                $layoutFile = $appModuleViewPath . '/Layout/' . $this->layout . '.php';
            }
        } else {
            // STEP: II 查找公用模块下的视图文件和框架文件
            $commonModuleViewPath = LEGO_PATH . '/Module/' . $moduleName . '/' . 'View';
            if (!$viewFile || !is_file($viewFile)) {
                $viewFile = $commonModuleViewPath . '/' . $view . '.php';
            }
            if (!$layoutFile || !is_file($layoutFile)) {
                $layoutFile = $commonModuleViewPath . '/Layout/' . $this->layout . '.php';
            }
        }

        //STEP: III 查找APP公用的视图文件和框架文件
        if (!$viewFile || !is_file($viewFile)) {
            $viewFile = APP_PATH . '/View/' . $view . '.php';
        }
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