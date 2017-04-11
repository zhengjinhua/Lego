<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/13
 * Time: 14:41
 */

namespace Core;

use PDO;

/**
 * 数据库访问层
 *
 * 集成的功能:读写分离
 *
 * @package Core
 */
class DB
{
    private static $instance;

    private $config;
    private $configTPL = [
        'database_type' => '',
        'host' => '',
        'port' => '',
        'socket' => '',
        'username' => '',
        'password' => '',
        'database_name' => '',
        'charset' => '',
        'option' => []
    ];

    private $masterPDO = null;
    private $slavePDO = null;

    private $bindVar = [];

    /**
     * @param $config
     */
    private function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * 单例接口
     * @param array $config
     * @return mixed
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
     * 查询单行数据
     * @param string $table
     * @param array $columns
     * @param array $where
     * @return bool
     */
    public function get($table, $columns = [], $where = [])
    {
        $Statement = $this->execute($this->selectContext($table, $columns, $where) . ' LIMIT 1');
        return $Statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * 查询COUNT,SUM...,单个字段
     * @param string $table 表名
     * @param string $column 字段
     * @param array $where 条件
     * @return int
     */
    public function column($table, $column, $where = [])
    {
        if (isset($where['ORDER'])) {
            unset($where['ORDER']);
        }
        $Statement = $this->execute($this->selectContext($table, $column, $where) . ' LIMIT 1');
        return $Statement->fetchColumn();
    }

    /**
     * 查询数据
     * @param string $table 表名
     * @param array $columns 查询列
     * @param array $where 条件
     * @return array|bool
     */
    public function select($table, $columns = [], $where = [])
    {
        $Statement = $this->execute($this->selectContext($table, $columns, $where));
        return $Statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 查询是否存在数据
     * @param string $table 表名
     * @param array $where 条件
     * @return bool
     */
    public function has($table, $where = [])
    {
        $Statement = $this->execute('SELECT EXISTS(' . $this->selectContext($table, [], $where) . ')');
        return intval($Statement->fetchColumn());
    }

    /**
     * 删除数据
     * @param string $table 表名
     * @param array $where 条件
     * @return int
     */
    public function delete($table, $where)
    {
        $Statement = $this->execute("DELETE FROM `{$table}` " . $this->where($where));
        return $Statement->rowCount();
    }

    /**
     * 更新数据
     *
     * $data格式
     *  key 字段名,支持8个一元运算符
     *  value 字符串,数字,不支持mysql函数
     * 8中运算符格式
     * 'field [+]'=> 600, 自增
     * 'field [-]'=> 600, 自减
     * 'field [*]'=> 600, 自乘
     * 'field [/]'=> 600, 自除
     * 'field [%]'=> 600, 取模
     * 'field [&]'=> 600, 与
     * 'field [|]'=> 600, 或
     * 'field [^]'=> 600, 异或
     *
     * @param string $table 表名
     * @param array $data 数据
     * @param array $where 条件
     * @return int  受影响的行数
     * @throws \Exception
     */
    public function update($table, $data, $where = [])
    {
        $columns = [];
        foreach ($data as $key => $value) {
            preg_match('/([\w]+)\s*(\[(\+|\-|\*|\/|\%|\&|\|)\])?/i', $key, $match);//mysql运算符
            if (isset($match[3])) {
                array_push($columns, "`{$match[1]}` = `{$match[1]}` {$match[3]} " . $this->placeholder($value));
            } else {
                array_push($columns, "`{$key}` = " . $this->placeholder($value));
            }
        }
        $Statement = $this->execute("UPDATE `{$table}` SET " . implode(',', $columns) . $this->where($where));
        return $Statement->rowCount();
    }

    /**
     * 插入数据
     *
     * $data格式
     *  key 字段名
     *  value 字符串,数字,不支持mysql函数
     *
     * @param string $table 表名
     * @param array $datas 数据
     * @param bool $replace
     * @return int 受影响的行数
     * @throws \Exception
     */
    public function insert($table, $datas, $replace = false)
    {
        if (!isset($datas[0])) {
            $datas = [$datas];
        }
        $columns = array_keys($datas[0]);
        $values = [];
        foreach ($datas as $data) {
            $bindVarNames = [];
            foreach ($data as $key => $value) {
                array_push($bindVarNames, $this->placeholder($value));
            }
            array_push($values, '(' . implode(',', $bindVarNames) . ')');
        }

        $method = $replace ? 'REPLACE' : 'INSERT';
        $Statement = $this->execute("{$method} INTO `{$table}` (`" . implode('`,`', $columns) . '`) VALUES ' . implode(',', $values));

        return $Statement->rowCount();
    }

    /**
     * SQL查询
     * @param $sql
     * @return \PDOStatement
     * @throws \Exception
     */
    public function query($sql)
    {
        return $this->master()->query($sql);
    }

    /**
     * SQL执行
     * @param $sql
     * @return int
     * @throws \Exception
     */
    public function exec($sql)
    {
        return $this->master()->exec($sql);
    }

    public function lastInsertId()
    {
        return $this->master()->lastInsertId();
    }

    /**
     * 事务开启
     * @return bool
     * @throws \Exception
     */
    public function beginTransaction()
    {
        return $this->master()->beginTransaction();
    }

    /**
     * 事务提交
     * @return bool
     * @throws \Exception
     */
    public function commit()
    {
        return $this->master()->commit();
    }

    /**
     * 事务回滚
     * @return bool
     * @throws \Exception
     */
    public function rollBack()
    {
        return $this->master()->rollBack();
    }

    /**
     * master链接
     * @return \PDO
     * @throws \Exception
     */
    private function master()
    {
        if ($this->masterPDO === null) {
            try {
                $this->masterPDO = $this->connect($this->config);
            } catch (\PDOException $e) {
                throw new \Exception("DB {$this->config['host']}:{$this->config['port']} CONNECT ERROR", 602);
            }

            if (!empty($this->config['charset'])) {
                $this->masterPDO->query("SET NAMES '{$this->config['charset']}'");
            }
            $this->masterPDO->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
            $this->masterPDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }

        return $this->masterPDO;
    }

    /**
     * slave链接
     * @return \PDO
     * @throws \Exception
     */
    private function slave()
    {
        if ($this->slavePDO === null) {
            if (isset($this->config['slave'])) {
                if (isset($this->config['slave']['database_type'])) {
                    $slaves[] = $this->config['slave'];
                } else {
                    $slaves = $this->config['slave'];
                }

                count($slaves) > 1 && shuffle($slaves);
                while ($slaves) {
                    $config = array_pop($slaves);
                    try {
                        $this->slavePDO = $this->connect($config);
                    } catch (\PDOException $e) {
                        trigger_error("DB {$config['host']}:{$config['port']} CONNECT ERROR");
                        continue;
                    }
                }
                if ($this->slavePDO instanceof \PDO) {
                    if (!empty($config['charset'])) {
                        $this->slavePDO->query("SET NAMES '{$config['charset']}'");
                    }
                    $this->slavePDO->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
                    $this->slavePDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

                    return $this->slavePDO;
                }
            }
            $this->slavePDO = $this->master();
        }

        return $this->slavePDO;
    }

    /**
     * 连接数据库
     * @param array $config
     * @return PDO
     */
    private function connect($config)
    {
        $config = array_merge($this->configTPL, $config);

        $port = isset($config['port']) && is_int($config['port'] * 1) ? $config['port'] : false;
        $type = strtolower($config['database_type']);
        $dsn = '';
        switch ($type) {
            case 'mysql':
                if (!empty($config['socket'])) {
                    $dsn = "$type:unix_socket={$config['socket']};dbname={$config['database_name']}";
                } else {
                    $dsn = $type . ':host=' . $config['host'] . ($port ? ';port=' . $port : '') . ';dbname=' . $config['database_name'];
                }
                break;
            case 'pgsql':
                $dsn = $type . ':host=' . $config['host'] . ($port ? ';port=' . $port : '') . ';dbname=' . $config['database_name'];
                break;
            case 'mssql':
                $dsn = strstr(PHP_OS, 'WIN') ?
                    'sqlsrv:server=' . $config['host'] . ($port ? ',' . $port : '') . ';database=' . $config['database_name'] :
                    'dblib:host=' . $config['host'] . ($port ? ':' . $port : '') . ';dbname=' . $config['database_name'];
                break;
        }
        $pdo = new PDO(
            $dsn,
            $config['username'],
            $config['password'],
            $config['option']
        );
        return $pdo;
    }

    /**
     * SQL执行
     * @param string $sql
     * @return \PDOStatement
     * @throws \Exception
     */
    private function execute($sql)
    {
        Event::raise('CORE.DB.EXECUTE.PRE', $sql, $this->bindVar);

        if (strtoupper(substr($sql, 0, 6)) === 'SELECT') {
            $pdo = $this->slave();
        } else {
            $pdo = $this->master();
        }
        $Statement = $pdo->prepare($sql);
        if ($Statement === false) {
            throw new \Exception("PDO PREPARE ERROR: {$sql} " . json_encode($this->bindVar), 603);
        }

        foreach ($this->bindVar as $name => $value) {
            if (is_int($value) || is_float($value)) {
                $Statement->bindValue($name, $value, PDO::PARAM_INT);
            } else {
                $Statement->bindValue($name, $value, PDO::PARAM_STR);
            }
        }

        $this->bindVar = [];

        $Statement->execute();

        return $Statement;
    }

    /**
     * 查询语句组装
     *
     * $columns格式 支持所有mysql允许的格式
     * 如:['field','SUM(field) AS sum']
     *
     * $where格式
     * [
     *  'AND'=>['field'=> 'val','field'=> 'val'],
     *  'OR' =>['field'=> 'val','field'=> 'val'],
     *  'OR' = [
     *      ['field'=> 'val','field'=> 'val'],
     *      ['field'=> 'val','field'=> 'val']
     *  ]
     *  'GROUP' => 'field ASC',
     *  'HAVING' => ['field'=> 'val'],
     *  'ORDER' => 'field ASC',
     *  'LIMIT' => 10
     * ]
     *
     * $where底层格式
     *  key 字段名,支持15操作符格式,支持mysql函数
     *  value 字符串,数字,不支持mysql函数
     *
     * 15操作符格式
     * 'field [>]'=> 600,
     * 'field [>]'=> 600,
     * 'field [<]'=> 600,
     * 'field [>=]'=> 600,
     * 'field [<=]'=> 600,
     * 'field [!=]'=> 600,
     * 'field [<>]'=> 600,
     * 'field [&]'=> 1,  位运行与
     * 'field [!&]'=> 1, 位运行取反
     * 'field [IN]'=> ['val','val'],
     * 'field [!IN]'=> ['val','val'],
     * 'field [LIKE]'=> 'val',
     * 'field [!LIKE]'=> 'val',
     * 'field [BETWEEN]'=> [500,1000],
     * 'field [!BETWEEN]'=> [500,1000],
     * 函数格式
     * 'YEAR(field)'=>2015
     *
     * @param string $table 表名
     * @param array $columns 字段
     * @param array $where 条件
     * @return string
     */
    private function selectContext($table, $columns = [], $where = [])
    {
        $table = "`{$table}`";

        if (!$columns) {
            $columns = ['*'];
        } elseif (is_string($columns)) {
            $columns = [$columns];
        }

        $columns = array_map('trim', $columns);

        $columnArr = [];
        foreach ($columns as $column) {
            preg_match('/([\w\-\.\(\)\*]+)\s+AS\s+([\w\-]+)/i', $column, $match);

            if (isset($match[1], $match[2])) {
                if (strpos($match[1], '(')) {
                    array_push($columnArr, "{$match[1]} AS `{$match[2]}`");
                } else {
                    array_push($columnArr, "`{$match[1]}` AS `{$match[2]}`");
                }
            } else {
                if ($column === '*' || strpos($column, ' ') || strpos($column, '(')) {
                    array_push($columnArr, $column);
                } else {
                    array_push($columnArr, "`{$column}`");
                }
            }
        }

        $columnStr = implode(',', $columnArr);

        return "SELECT {$columnStr} FROM {$table} " . $this->where($where);
    }

    /**
     * 条件语句组装
     *
     * $where格式
     * [
     *  'AND'=>['field'=> 'val','field'=> 'val'],
     *  'OR' =>['field'=> 'val','field'=> 'val'],
     *  'OR' = [
     *      ['field'=> 'val','field'=> 'val'],
     *      ['field'=> 'val','field'=> 'val']
     *  ]
     *  'GROUP' => 'field ASC',
     *  'HAVING' => ['field'=> 'val'],
     *  'ORDER' => 'field ASC',
     *  'LIMIT' => 10
     * ]
     *
     * @param array $where 条件
     * @return string
     */
    private function where($where)
    {
        $where_clause = '';
        if ($where) {
            $condition = array_diff_key($where, array_flip(['GROUP', 'HAVING', 'ORDER', 'LIMIT']));
            if ($condition != []) {
                $where_clause .= ' WHERE ' . implode(' AND ', $this->whereCondition($condition));
            }

            if (isset($where['GROUP'])) {
                $where_clause .= " GROUP BY {$where['GROUP']}";
                if (isset($where['HAVING'])) {
                    $where_clause .= ' HAVING ' . implode(' AND ', $this->whereCondition($where['HAVING']));
                }
            }

            if (isset($where['ORDER'])) {
                $where_clause .= " ORDER BY {$where['ORDER']}";
            }

            if (isset($where['LIMIT'])) {
                $LIMIT = $where['LIMIT'];
                if (is_numeric($LIMIT)) {
                    $where_clause .= " LIMIT {$LIMIT}";
                }
                if (is_array($LIMIT) && is_numeric($LIMIT[0]) && is_numeric($LIMIT[1])) {
                    if ($this->config['database_type'] === 'pgsql') {
                        $where_clause .= " OFFSET {$LIMIT[0]} LIMIT {$LIMIT[1]}";
                    } else {
                        $where_clause .= " LIMIT {$LIMIT[0]},{$LIMIT[1]}";
                    }
                }
            }
        }
        return $where_clause;
    }

    /**
     * 条件语句操作符处理
     *
     * $condition格式
     *  key 字段名,支持15操作符格式,支持mysql函数
     *  value 字符串,数字,不支持mysql函数
     *
     * 15操作符格式
     * 'field [>]'=> 600,
     * 'field [>]'=> 600,
     * 'field [<]'=> 600,
     * 'field [>=]'=> 600,
     * 'field [<=]'=> 600,
     * 'field [!=]'=> 600,
     * 'field [<>]'=> 600,
     * 'field [&]'=> 1,  位运行与
     * 'field [!&]'=> 1, 位运行取反
     * 'field [IN]'=> ['val','val'],
     * 'field [!IN]'=> ['val','val'],
     * 'field [LIKE]'=> 'val',
     * 'field [!LIKE]'=> 'val',
     * 'field [BETWEEN]'=> [500,1000],
     * 'field [!BETWEEN]'=> [500,1000],
     * 函数格式
     * 'YEAR(field)'=>2015
     *
     * @param array $condition 条件关联数据
     * @return array
     */
    private function whereCondition($condition)
    {
        $wheres = [];
        foreach ($condition as $key => $value) {
            $upKey = strtoupper(trim($key));
            if (in_array($upKey, ['AND', 'OR']) && is_array($value)) {
                array_push($wheres, '(' . implode(" {$upKey} ", $this->whereCondition($value)) . ')');
            } elseif (is_int($key) && is_array($value)) {
                array_push($wheres, implode(" AND ", $this->whereCondition($value)));
            } else {
                preg_match('/([\w]+)\s*(\[(\>|\>\=|\<|\<\=|\!\=|\<\>|\&|\!\&|IN|\!IN|LIKE|\!LIKE|BETWEEN|\!BETWEEN)\])?/i', $key, $match);
                $column = "`{$match[1]}`";
                if (isset($match[3])) {
                    $operator = strtoupper($match[3]);
                    if (in_array($operator, ['>', '>=', '<', '<=', '<>', '!='])) {
                        array_push($wheres, "{$column} {$operator} " . $this->placeholder($value));
                    } elseif (in_array($operator, ['&', '!&'])) {
                        $value = intval($value);
                        if ($operator === '!&') {
                            array_push($wheres, "!({$column} & {$value})");
                        } else {
                            array_push($wheres, "{$column} & {$value} ");
                        }
                    } elseif ($operator === 'IN' || $operator === '!IN') {
                        if ($operator === '!IN') {
                            $column .= ' NOT';
                        }
                        array_push($wheres, "{$column} IN (" . $this->placeholder($value) . ")");
                    } elseif ($operator === 'BETWEEN' || $operator === '!BETWEEN') {
                        if (is_array($value)) {
                            if ($operator === '!BETWEEN') {
                                $column .= ' NOT';
                            }
                            array_push($wheres, "{$column} BETWEEN " . $this->placeholder($value[0]) . ' AND ' . $this->placeholder($value[1]));
                        }
                    } elseif ($operator === 'LIKE' || $operator === '!LIKE') {
                        if ($operator === '!LIKE') {
                            $column .= ' NOT';
                        }
                        array_push($wheres, "{$column} LIKE " . $this->placeholder($value));
                    }
                } else {
                    array_push($wheres, "{$column} = " . $this->placeholder($value));
                }
            }
        }
        return $wheres;
    }

    /**
     * 命名占位符绑定
     * @param string|array $value
     * @return string
     */
    private function placeholder($value)
    {
        static $bindVarIncrement = 1;

        if (!is_array($value)) {
            $bindVarName = ':v_' . $bindVarIncrement++;
            $this->bindVar[$bindVarName] = $value;
            return $bindVarName;
        }

        $result = [];
        foreach ($value as $v) {
            $bindVarName = ':v_' . $bindVarIncrement++;
            $this->bindVar[$bindVarName] = $v;
            $result[] = $bindVarName;
        }
        return implode(',', $result);
    }
}
