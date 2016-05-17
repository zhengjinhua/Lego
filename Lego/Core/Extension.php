<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/8
 * Time: 20:19
 */

namespace Core;

/**
 * 框架扩展类
 *
 * 集成的功能: 插件,模块,模块插件
 * @package Core
 */
class Extension
{
    /**
     * 加载模块
     */
    public static function loadModule()
    {
        $modules = self::getModuleList();
        foreach ($modules as $moduleName) {
            $className = "\\Module\\{$moduleName}\\Module";
            if (!is_subclass_of($className, '\Core\ModuleInterface')) {
                throw new \Exception("{$className} NOT IMPLEMENTS \\Core\\ModuleInterface", 500);
            }
            Log::info("INIT MODULE {$moduleName}");
            $className::init();

            $plugins = glob(APP_PATH . '/Module/' . $moduleName . '/Plugin/*');
            if ($plugins) {
                $pluginNames = array_map('basename', $plugins);
                $pluginNames = array_unique($pluginNames);
                foreach ($pluginNames as &$pluginName) {
                    $pluginName = "{$moduleName}\\Plugin\\{$pluginName}";
                }
                self::loadPlugin($pluginNames);
            }
        }
    }

    /**
     * 加载插件
     *
     * @param array $modulePlugins 模块插件列表
     *
     * @throws \Exception
     */
    public static function loadPlugin($modulePlugins = [])
    {
        $isModule = !!$modulePlugins;
        $plugins = $isModule ? $modulePlugins : self::getPluginList();

        foreach ($plugins as $pluginName) {
            $className = $isModule ? "\\Module\\{$pluginName}\\Plugin" : "\\Plugin\\{$pluginName}\\Plugin";
            if (!is_subclass_of($className, '\Core\PluginInterface')) {
                throw new \Exception("{$className}  NOT IMPLEMENTS \\Core\\PluginInterface", 500);
            }
            Log::info("REGISTER PLUGIN {$pluginName}");
            $className::register();
        }
    }

    /**
     * 获取模块列表
     *
     * @return array|null
     */
    public static function getModuleList()
    {
        $modules = glob(APP_PATH . '/Module/*');
        $modules = array_map('basename', $modules);
        $modules = array_unique($modules);

        return $modules;
    }

    /**
     * 获取插件列表
     * @return array|null
     */
    public static function getPluginList()
    {
        //cli模式不使用插件
        if (PHP_SAPI === 'cli') {
            return [];
        }

        $plugins = glob(APP_PATH . '/Plugin/*');
        $plugins = array_map('basename', $plugins);
        $plugins = array_unique($plugins);

        return $plugins;
    }

    public static function breakToMain()
    {
        throw new BreakException();
    }
}

/**
 * 模块接口
 * @package Core
 */
interface ModuleInterface
{
    /**
     * 模块初始化
     * @return mixed
     */
    public static function init();
}

/**
 * 插件接口
 * @package Core
 */
interface PluginInterface
{
    /**
     * 插件注册
     * @return mixed
     */
    public static function register();
}

/**
 * 插件中断请求处理
 * @package Core
 */
class BreakException extends \Exception
{
    public function __construct($message = "PLUGIN BREAK")
    {
        parent::__construct($message);
    }
}