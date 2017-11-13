<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/10
 * Time: 14:06
 */

namespace Plugin\HTMLCompress;

use Core\Event;
use Core\PluginInterface;

/**
 * HTML压缩
 * @package Plugin\HTMLCompress
 */
class Plugin implements PluginInterface
{
    public static function register()
    {
        Event::attach('CORE.VIEW.RENDER.PRE', function () {
            //开启输出控制
            ob_start();
            Event::attach('CORE.VIEW.RENDER.POST', function () {
                $html = ob_get_clean();
                //过滤单行注释
                $html = preg_replace('#([^:|\"])//.*#', '$1', $html);
                //过滤多行注释
                $html = preg_replace(['#/\*.*\*/#sU', '#<!--.*-->#sU'], ' ', $html);
                //过滤换行和空格
                $html = preg_replace(['#\s*\n+\s*#', '#\s{2,}#', "#>\s+<#"], [' ', ' ', '><'], $html);
                echo $html;
            });
        });
    }
}