<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/10
 * Time: 17:30
 */

namespace Core;

/**
 * 框架日志类
 * @package Core
 */
class Log
{
    private static $logDir = '';
    private static $logs = [];

    private static $level = 0XFF;

    /**
     * @param int $level
     */
    public static function setLevel($level)
    {
        $level && self::$level = $level;
        self::$logDir = APP_PATH . '/Var/Log/';
        if (!is_dir(self::$logDir)) {
            mkdir(self::$logDir, 0777, true);
        }
    }

    /**
     * @param string $str
     */
    public static function info($str)
    {
        self::write($str, 1);
    }

    /**
     * @param string $str
     */
    public static function debug($str)
    {
        self::write($str, 2);
    }

    /**
     * @param string $str
     */
    public static function error($str)
    {
        self::write($str, 4);
    }

    /**
     * @param string $str
     * @param int $level
     */
    private static function write($str, $level)
    {
        if ($level & self::$level) {
            $dateTime = date('Y-m-d H:i:s');
            $levelStr = $level & 1 ? 'INFO' : ($level & 2 ? 'DEBUG' : 'ERROR');
            $log = "[{$dateTime}][{$levelStr}] {$str}\n";
            self::$logs[] = $log;
            if (PHP_SAPI === 'cli') {
                self::writeLog();
            }
        }
    }

    public static function writeLog()
    {
        if (!self::$logs) {
            return;
        }
        $log = implode('', self::$logs);

        $hostName = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
        $logFileName = date('Ymd') . '.' . PHP_SAPI . '.' . $hostName . '.log';
        $logPath = self::$logDir . $logFileName;
        file_put_contents($logPath, $log, FILE_APPEND | LOCK_EX);
        self::$logs = [];
    }
} 