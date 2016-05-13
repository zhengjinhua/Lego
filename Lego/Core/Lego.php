<?php

/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/8
 * Time: 18:30
 */

namespace Core;

class Lego
{
    /**
     * 项目运行
     *
     * @param string $appPath 项目路径
     * @param string $appConfigFile 配置文件
     *
     * @throws \Exception
     */
    public static function run($appPath, $appConfigFile = 'config')
    {
        ################应用初始化#############################
        define('APP_PATH', $appPath);
        define('LEGO_PATH', dirname(__DIR__));

        self::repairPathInfo();

        //自动加载
        spl_autoload_register('self::autoLoad');

        //异常处理
        self::registerHandler();

        //加载配置文件
        Config::load($appConfigFile);

        //配置日志
        Log::setLevel(Config::get('LOG_LEVEL'));
        register_shutdown_function('\Core\Log::writeLog');

        //请求初始化
        Log::info('REQUEST START');

        try {
            //加载插件
            Extension::loadPlugin();

            Event::raise('CORE.REQUEST.INIT');

            //加载模块
            Event::raise('CORE.MODULE.LOAD.PRE');
            Extension::loadModule();
            Event::raise('CORE.MODULE.LOAD.POST');

            #################请求处理###############################
            //匹配路由
            Event::raise('CORE.ROUTE.PRE');
            list($callback, $args) = Router::match();
            $callbackName = is_string($callback) ? $callback : null;
            Log::info("ROUTER MATCH {$_SERVER['PATH_INFO']} => {$callbackName}");
            Event::raise('CORE.ROUTE.POST', $callbackName);

            //实例化控制器
            if ($callbackName && strpos($callbackName, '::') !== false) {
                list($controller, $action) = explode('::', $callback);
                $Controller = new $controller;
                $Controller->run($action, $args);
            } else {
                call_user_func_array($callback, $args);
            }
        } catch (BreakException $b) {

        }

        //请求结束
        Event::raise('CORE.REQUEST.OVER');
        Log::info('REQUEST OVER');
    }

    /**
     * 规范PATH_INFO,为了路由
     */
    private function repairPathInfo()
    {
        if (PHP_SAPI === 'cli') {
            $_SERVER['REQUEST_METHOD'] = 'CLI';
            $_SERVER['PATH_INFO'] = isset($_SERVER['argv'][1]) ? $_SERVER['argv'][1] : '/';
        } else {
            $_SERVER['REQUEST_METHOD'] === 'CLI' && $_SERVER['REQUEST_METHOD'] = 'GET';
            empty($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] = '/';
        }
    }

    /**
     * 框架自动加载文件查找规则
     *      1 项目下Module/Plugin
     *      2 Lego下Core/Module/Plugin
     *      3 项目下Lib
     *      4 Lego下Lib
     *
     * @param string $className 类名
     *
     * @throws \Exception
     */
    private static function autoLoad($className)
    {
        $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        if ($className[0] !== DIRECTORY_SEPARATOR) {
            $className = DIRECTORY_SEPARATOR . $className;
        }

        $appFile = APP_PATH . $className . '.php';
        $legoFile = LEGO_PATH . $className . '.php';
        $appLibFile = APP_PATH . DIRECTORY_SEPARATOR . 'Lib' . $className . '.php';
        $legoLibFile = LEGO_PATH . DIRECTORY_SEPARATOR . 'Lib' . $className . '.php';

        switch (1) {
            case is_file($appFile):
                $file = $appFile;
                break;
            case is_file($legoFile):
                $file = $legoFile;
                break;
            case is_file($appLibFile):
                $file = $appLibFile;
                break;
            case is_file($legoLibFile):
                $file = $legoLibFile;
                break;
            default:
                throw new \Exception("{$className}.php CLASS LOAD ERROR", 500);
        }

        require $file;
    }

    /**
     * 注册错误/异常处理函数
     */
    private static function registerHandler()
    {
        set_error_handler(function ($errNo, $errStr, $errFile, $errLine) {
            $err = sprintf('%s %s(%s)', $errStr, $errFile, $errLine);

            Log::error($err);

            if (ini_get('display_errors') == 1) {
                echo $err, "\n";
            }
        });
        set_exception_handler(function (\Exception $e) {
            $err = sprintf('%s %s(%s)', $e->getMessage(), $e->getFile(), $e->getLine());

            Log::error($err);

            if (ini_get('display_errors') == 1) {
                echo $err, "\n";
            } else {
                $code = $e->getCode();
                switch ($code) {
                    case 404:
                    case 500:
                        header("Location: /{$code}.html");
                        break;
                    default:
                        header("Location: /500.html");
                }
            }
        });
    }
}