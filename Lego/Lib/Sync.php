<?php

/**
 * Created by PhpStorm.
 * User: zjh
 * Date: 2017/3/19
 * Time: 21:57
 */
use Core\Config;

class Sync
{
    private static $instance;
    private $Redis = null;

    private function __construct()
    {
        $cacheConfig = Config::get('CACHE');
        if ($cacheConfig['driver'] === 'redis') {
            $this->Redis = new \Redis();
            $this->Redis->connect($cacheConfig['host'], $cacheConfig['port'], $cacheConfig['timeout']);

            if (!empty($config['password'])) {
                $this->Redis->auth($config['password']);
            }
            if (!empty($config['db'])) {
                $this->Redis->select($config['db']);
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
        $result = $this->Redis->setnx($identify, 1);
        if ($result) {
            $this->Redis->expire($identify, $timeout);
            return true;
        } else {
            return false;
        }
    }

    public function unlock($identify)
    {
        return $this->Redis->delete($identify);
    }
}