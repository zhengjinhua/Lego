<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/8
 * Time: 21:45
 */

namespace Core;

/**
 * 事件注册表
 *
 * Class Event
 * @package Core
 */
class Event
{
    private static $map = [];

    /**
     * 添加事件处理回调
     *
     * @param string $name 事件
     * @param callback $handler 回调
     * @throws \Exception
     */
    public static function attach($name, $handler)
    {
        if (!is_string($name)) {
            throw new \Exception("{$name} EVENT NAME ERROR", 500);
        }
        if (!is_callable($handler)) {
            throw new \Exception("{$handler} EVENT HANDLER ERROR", 500);
        }
        self::$map[$name][] = $handler;
    }

    /**
     * 触发事件
     *
     * @param string $name 事件
     */
    public static function raise($name)
    {
        $args = func_get_args();
        array_shift($args);
        if (isset(self::$map[$name])) {
            foreach (self::$map[$name] as $handler) {
                call_user_func_array($handler, $args);
            }
        }
    }

    /**
     * 获取注册表
     * @return array
     */
    public static function map()
    {
        return self::$map;
    }
}