<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/10
 * Time: 14:06
 */

namespace Plugin\SQLDump;

use Core\Event;
use Core\Config;
use Core\PluginInterface;

/**
 * SQL调试输出
 *
 * @package Plugin\SQLDump
 */
class Plugin implements PluginInterface
{
    private static $sqls = [];

    public static function register()
    {
        if (!isset($_GET['SQLDUMP'])) {
            return;
        }

        Event::attach('CORE.DB.EXECUTE.PRE', function ($sql, $bindVar) {
            self::$sqls[] = $sql . ' ' . json_encode($bindVar);
        });

        Event::attach('CORE.REQUEST.OVER', function () {
            if (self::$sqls) {
                echo "<script>console.log('SQLDump:\\n" . implode('\n', self::$sqls) . "')</script>";
            }
        });


    }
}