<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/10
 * Time: 17:29
 */

namespace Core;

/**
 * 配置注册表
 * @package Core
 */
class Config
{
    private static $map = [];

    /**
     * 加载配置文件
     * @param string $appConfigFile
     */
    public static function load($appConfigFile)
    {
        //框架配置文件
        static $loadedLegoConfig = false;
        if (!$loadedLegoConfig) {
            include(LEGO_PATH . '/Conf/config.php');
            $loadedLegoConfig = true;
        }
        if (substr($appConfigFile, -4) !== '.php') {
            $appConfigFile = $appConfigFile . '.php';
        }
        $appConfigFile = APP_PATH . '/Conf/' . $appConfigFile;
        if (!is_file($appConfigFile)) {
            throw new \Exception("CONFIG FILE {$appConfigFile} LOAD ERROR", 601);
        }
        include($appConfigFile);
    }

    /**
     * @param string|null $name
     * @return mixed|null
     */
    public static function get($name = null)
    {
        if ($name === null) {
            return self::$map;
        }
        if (isset(self::$map[$name])) {
            return self::$map[$name];
        }
        return null;
    }

    /**
     * @param string $name
     * @param mixed $val
     */
    public static function set($name, $val = null)
    {
        if (is_array($name)) {
            self::$map = array_merge(self::$map, $name);
        } else {
            self::$map[$name] = $val;
        }

    }
} 