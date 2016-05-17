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
            throw new \Exception("{$action} ACTION NOT FIND", 500);
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
     * @param string $viewFile
     * @param string $layout
     * @throws \Exception
     */
    final protected function render($viewFile, $layout = null)
    {
        //获取模块视图路径
        $calledClassPath = explode('\\', get_called_class());
        $viewPath = implode(DIRECTORY_SEPARATOR, array_slice($calledClassPath, 0, -2));
        $moduleViewPath = APP_PATH . DIRECTORY_SEPARATOR . $viewPath . DIRECTORY_SEPARATOR . 'View';

        //检查视图文件
        $viewFile = $moduleViewPath . DIRECTORY_SEPARATOR . $viewFile . '.php';
        if (!is_file($viewFile)) {
            throw new \Exception("{$viewFile} VIEW NOT FIND", 500);
        }

        if ($layout !== null) {
            $this->layout = $layout;
        }

        //检查框架文件
        $moduleLayout = $moduleViewPath . DIRECTORY_SEPARATOR . 'Layout' . DIRECTORY_SEPARATOR . $this->layout . '.php';
        $appLayout = APP_PATH . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . 'Layout' . DIRECTORY_SEPARATOR . $this->layout . '.php';
        if (is_file($moduleLayout)) {
            $layoutFile = $moduleLayout;
        } elseif (is_file($appLayout)) {
            $layoutFile = $appLayout;
        } else {
            throw new \Exception("{$this->layout} LAYOUT NOT FIND", 500);
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