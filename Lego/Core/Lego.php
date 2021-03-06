<?php

/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/8
 * Time: 18:30
 */

namespace Core;

/**
 * 框架入口类
 * @package Core
 */
class Lego
{
    /**
     * 框架入口
     *
     * @param string $appPath 项目路径
     * @param string $appConfigFile 配置文件
     *
     */
    public static function run($appPath, $appConfigFile = 'config')
    {
        ################应用初始化#############################
        define('APP_PATH', $appPath);
        define('LEGO_PATH', dirname(__DIR__));

        //自动加载
        self::setIncludePath();
        spl_autoload_register('self::autoLoad');

        //初始化依赖参数
        Env::init();

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
            //加载模块
            Extension::loadModule();

            //加载插件
            Extension::loadPlugin();

            #################请求处理###############################
            Event::raise('CORE.REQUEST.INIT');

            //匹配路由
            Event::raise('CORE.ROUTE.PRE');
            list($callback, $args) = Router::match();
            $callbackName = is_string($callback) ? $callback : null;
            Log::info("ROUTER MATCH " . Env::get('PATH_INFO') . " => " . $callbackName);

            Event::raise('CORE.ROUTE.POST', $callbackName);

            //实例化控制器
            if ($callbackName && strpos($callbackName, '::') !== false) {
                list($controllerClass, $action) = explode('::', $callback);
                $controller = new $controllerClass;
                $controller->run($action, $args);
            } else {
                call_user_func_array($callback, $args);
            }
        } catch (BreakException $b) {

        }

        //请求结束
        Event::raise('CORE.REQUEST.OVER');
        Log::info('REQUEST OVER');
    }

    private static function setIncludePath()
    {
        $includePathArr = array(
            APP_PATH . PATH_SEPARATOR,
            LEGO_PATH . PATH_SEPARATOR,
            APP_PATH . '/Lib' . PATH_SEPARATOR,
            LEGO_PATH . '/Lib' . PATH_SEPARATOR
        );

        $includePathArr = implode(PATH_SEPARATOR, $includePathArr);
        set_include_path($includePathArr);
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
     */
    private static function autoLoad($className)
    {
        $className = str_replace('\\', '/', $className);
        $file = $className[0] === '/' ? substr($className, 1) . '.php' : $className . '.php';
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
        set_exception_handler(function ($e) {

            $err = sprintf("%s %s(%s)\n%s", $e->getMessage(), $e->getFile(), $e->getLine(), $e->getTraceAsString());
            Log::error($err);
            if (ini_get('display_errors') == 1) {
                echo $err, "\n";
            } else {
                $code = $e->getCode();
                if ($code < 600 || $code > 690) {
                    $code = 699;
                }
                header("HTTP/1.1 {$code} Exception");
            }
        });
    }
}