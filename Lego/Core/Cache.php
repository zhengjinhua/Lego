<?php
/**
 * Created by PhpStorm.
 * User: zjh
 * Date: 16/1/11
 * Time: 00:02
 */

namespace Core;

/**
 * 缓存类
 * @package Core
 */
class Cache
{
    /**
     * @var array
     */
    private static $instance;

    /**
     * @var RedisCache|FileCache
     */
    private $driver = null;

    private function __construct($config)
    {
        switch ($config['driver']) {
            case 'file':
                $this->driver = new FileCache($config);
                break;
            case 'redis':
                $this->driver = new RedisCache($config);
                break;
        }
    }

    /**
     * @param $config
     * @return Cache
     */
    public static function instance($config)
    {
        $hash = md5(serialize($config));
        if (!isset(self::$instance[$hash])) {
            self::$instance[$hash] = new self($config);
        }
        return self::$instance[$hash];
    }

    /**
     * @param string $key
     * @return bool|mixed
     */
    public function get($key)
    {
        return $this->driver->get($key);
    }

    /**
     * @param string $key
     * @param mixed $data
     * @param int $time
     * @return bool
     */
    public function set($key, $data, $time)
    {
        return $this->driver->set($key, $data, $time);
    }

    /**
     * @param string $key
     * @return bool
     */
    public function del($key)
    {
        return $this->driver->del($key);
    }
}

/**
 * 文件缓存
 * @package Core
 */
class FileCache
{
    private $cacheDir;

    /**
     * @param $config
     */
    public function __construct($config)
    {
        $this->cacheDir = sys_get_temp_dir() . '/';
    }

    public function get($key)
    {
        $cacheFile = $this->cacheDir . $key;
        if (!is_file($cacheFile)) {
            return false;
        }

        $data = file_get_contents($cacheFile);
        $dataArr = explode('|', $data, 2);
        if (intval($dataArr[0]) >= $_SERVER['REQUEST_TIME']) {
            return unserialize($dataArr[1]);
        } else {
            unlink($cacheFile);
            return false;
        }
    }

    public function set($key, $data, $time)
    {
        $expireTime = $_SERVER['REQUEST_TIME'] + $time;
        $data = $expireTime . "|" . serialize($data);

        $result = file_put_contents($this->cacheDir . $key, $data);
        return $result ? true : false;
    }

    public function del($key)
    {
        $cacheFile = $this->cacheDir . $key;
        if (is_file($cacheFile)) {
            unset($cacheFile);
        }
        return true;
    }
}

/**
 * Redis缓存
 * @package Core
 */
class RedisCache
{
    /**
     * @var \Redis
     */
    private $Redis = null;

    /**
     * @param $config
     */
    public function __construct($config)
    {
        $this->Redis = new \Redis();
        $this->Redis->connect($config['host'], $config['port'], $config['timeout']);
        //$this->Redis->select($config['db']);
    }

    public function get($key)
    {
        $value = $this->Redis->get($key);
        return unserialize($value);
    }

    public function set($key, $data, $time)
    {
        return $this->Redis->set($key, serialize($data), $time);
    }

    public function del($key)
    {
        return $this->Redis->delete($key);
    }
}