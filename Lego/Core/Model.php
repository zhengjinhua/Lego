<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/9/5
 * Time: 22:01
 */

namespace Core;

/**
 * 模型类
 * 集成的功能:分表,数据库查询缓存,分页查询
 * @package Core
 */
abstract class Model
{
    private static $instance;

    protected $table;
    protected $config = [];

    protected $shardingKey = null;

    /**
     * @var \Core\Cache
     */
    private $cacheInstance = null;
    private $cacheKey = '';
    private $cacheTime = 0;

    /**
     * @var \Core\DB
     */
    private $db = null;

    private function __construct()
    {
        $this->init();
        if (!$this->config) {
            $this->config = Config::get('DB');
        }
        if (isset($this->config['table_pre'])) {
            $this->table = trim($this->config['table_pre'] . $this->table);
        }
        $this->db = DB::instance($this->config);
    }

    /**
     * @return \Core\Model
     */
    public static function instance()
    {
        $className = get_called_class();
        if (!isset(self::$instance[$className])) {
            self::$instance[$className] = new static;
        }
        return self::$instance[$className];
    }

    /**
     * 模型初始化回调
     * @return void
     */
    abstract protected function init();

    /**
     * 分表算法
     * @param int $key 分表字段
     * @return bool|int
     */
    protected function shardingAlgorithm($key)
    {
        return false;
    }

    /**
     * 分表情况下算出表名
     * @param $whereCondition
     * @throws \Exception
     */
    private function shardingTable($whereCondition)
    {
        //检查是否分表
        if (!$this->shardingKey) {
            return;
        }
        if (!isset($whereCondition[$this->shardingKey])) {
            throw new \Exception("MODEL SHARDING ERROR", 500);
        }

        //避免重复修改表名
        static $shardingKeyValue = null;
        if ($shardingKeyValue !== $whereCondition[$this->shardingKey]) {
            $shardingKeyValue = $whereCondition[$this->shardingKey];
        } else {
            return;
        }

        $tableNumber = $this->shardingAlgorithm($shardingKeyValue);
        if ($tableNumber === false) {
            throw new \Exception("MODEL SHARDING_ALGORITHM ERROR", 500);
        }
        $this->table = $this->table . '_' . $tableNumber;
    }

    /**
     * 设置缓存写一个查询
     * @param string $key
     * @param int $time
     * @return $this
     */
    final public function cache($time = 60, $key = '')
    {
        $this->cacheKey = $key;
        $this->cacheTime = $time;

        $cacheConfig = Config::get('CACHE');
        if ($cacheConfig) {
            $this->cacheInstance || $this->cacheInstance = Cache::instance($cacheConfig);
            if ($time === 0 && $key) {
                $this->cacheInstance->del($key);
            }
        }

        return $this;
    }

    /**
     * 缓存读取/设置
     * @param string $method
     * @param string|array $columns
     * @param array $where
     * @return mixed
     */
    private function cacheForDBQuery($method, $columns, $where)
    {
        if ($this->cacheInstance && $this->cacheTime) {
            if ($this->cacheKey === '') {
                $uuid = md5(serialize([$columns, $where]));
                $this->cacheKey = "{$this->table}.{$method}.{$uuid}";
            }
            $cacheData = $this->cacheInstance->get($this->cacheKey);
            if ($cacheData !== false) {
                return $cacheData;
            }
        }

        $data = $this->db->$method($this->table, $columns, $where);

        if ($this->cacheInstance && $this->cacheKey && $this->cacheTime) {
            $this->cacheInstance->set($this->cacheKey, $data, $this->cacheTime);
            $this->cacheKey = '';
            $this->cacheTime = 0;
        }

        return $data;
    }

    /**
     * 查询单条数据
     * @param array $where 条件
     * @param array $columns 列名
     * @return bool
     */
    final public function get($where = [], $columns = [])
    {
        $this->shardingTable($where);
        //return $this->db->get($this->table, $columns, $where);
        return $this->cacheForDBQuery('get', $columns, $where);
    }

    /**
     * 查询数据
     * @param array $where 条件
     * @param array $columns 列名
     * @return array|bool
     */
    final public function select($where = [], $columns = [])
    {
        $this->shardingTable($where);
        //return $this->db->select($this->table, $columns, $where);
        return $this->cacheForDBQuery('select', $columns, $where);
    }

    /**
     * 查询COUNT,SUM...,单个字段
     * @param string $column 列名
     * @param array $where 条件
     * @return bool
     */
    final public function column($column, $where = [])
    {
        $this->shardingTable($where);
        return $this->db->column($this->table, $column, $where);
    }

    /**
     * 插入数据
     * @param array $data
     * @return array|int
     */
    final public function insert($data)
    {
        $this->shardingTable($data);
        return $this->db->insert($this->table, $data);
    }

    /**
     * 更新数据
     * @param array $data
     * @param array $where
     * @return int
     */
    final public function update($data, $where = [])
    {
        $this->shardingTable($where);
        return $this->db->update($this->table, $data, $where);
    }

    /**
     * 删除数据
     * @param array $where
     * @return int
     */
    final public function delete($where)
    {
        $this->shardingTable($where);
        return $this->db->delete($this->table, $where);
    }

    /**
     * 查询是否存在数据
     * @param array $where
     * @return bool
     */
    final public function has($where = [])
    {
        $this->shardingTable($where);
        return $this->db->has($this->table, $where);
    }

    /**
     * 事务开启
     * @return bool
     * @throws \Exception
     */
    final public function beginTransaction()
    {
        return $this->db->beginTransaction();
    }

    /**
     * 事务提交
     * @return bool
     * @throws \Exception
     */
    final public function commit()
    {
        return $this->db->commit();
    }

    /**
     * 事务回滚
     * @return bool
     * @throws \Exception
     */
    final public function rollBack()
    {
        return $this->db->rollBack();
    }

    /**
     * SQL查询接口
     * @param string $sql
     * @return \PDOStatement
     * @throws \Exception
     */
    final public function query($sql)
    {
        return $this->db->query($sql);
    }

    /**
     * SQL执行接口
     * @param string $sql
     * @return int
     * @throws \Exception
     */
    final public function exec($sql)
    {
        return $this->db->exec($sql);
    }

    final public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }

    /**
     * 分页查询
     * @param \Page $Page 分页对象
     * @param array $where 条件
     * @param array $columns 列名
     * @return array|bool
     */
    final public function pageList(\Page $Page, $where = [], $columns = [])
    {
        $total = $this->column('COUNT(1)', $where);

        $Page->totalSize($total);

        $where['LIMIT'] = array(($Page->pageNumber() - 1) * $Page->pageSize(), $Page->pageSize());

        return $this->select($where, $columns);
    }
}