<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/10
 * Time: 14:06
 */

namespace Plugin\Concurrency;

use Core\Event;
use Core\PluginInterface;

/**
 * 并发控制
 *
 * 同一个接口在0.1s内禁止并发
 *
 * @package Plugin
 */
class Plugin implements PluginInterface
{
    public static function register()
    {
        //禁止单个用户在同个接口范围内并发
        Event::attach('CORE.ROUTE.POST', function ($callback) {

            if (!$callback) {
                return;
            }

            if (!isset($_SESSION)) {
                return;
            }

            if (isset($_SESSION['ConcurrenceLockAPI']) &&
                $_SESSION['ConcurrenceLockAPI'] === $callback &&
                isset($_SESSION['ConcurrenceLockTime']) &&
                $_SESSION['ConcurrenceLockTime'] > $_SERVER['REQUEST_TIME_FLOAT'] - 0.1
            ) {
                Util::redirect('/404.html');
            }

            $_SESSION['ConcurrenceLockAPI'] = $callback;
            $_SESSION['ConcurrenceLockTime'] = $_SERVER['REQUEST_TIME_FLOAT'];
        });

        Event::attach('CORE.REQUEST.OVER', function () {
            isset($_SESSION['ConcurrenceLockAPI']) && $_SESSION['ConcurrenceLockTime'] -= 100;
        });
    }
}