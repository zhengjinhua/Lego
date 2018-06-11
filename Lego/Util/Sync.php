<?php

/**
 * Created by PhpStorm.
 * User: zjh
 * Date: 2017/3/19
 * Time: 21:57
 */
namespace Util;

use Core\Config;

class Sync
{
    private static $instance;
    private $redis = null;

    private function __construct()
    {
        $cacheConfig = Config::get('CACHE');
        if ($cacheConfig['driver'] === 'redis') {
            $this->redis = new \Redis();
            $this->redis->connect($cacheConfig['host'], $cacheConfig['port'], $cacheConfig['timeout']);

            if (!empty($config['password'])) {
                $this->redis->auth($config['password']);
            }
            if (!empty($config['db'])) {
                $this->redis->select($config['db']);
            }
        } else {
            throw new \Exception("Sync CANNOT FIND Redis", 615);
        }
    }

    public function instance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function lock($identify, $timeout = 1)
    {
        $result = $this->redis->setnx($identify, 1);
        if ($result) {
            $this->redis->expire($identify, $timeout);
            return true;
        } else {
            return false;
        }
    }

    public function unlock($identify)
    {
        return $this->redis->delete($identify);
    }
}