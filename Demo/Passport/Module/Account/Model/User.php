<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/9/7
 * Time: 22:45
 */

namespace Model;

use Core\Model;

class User extends Model
{
    protected function init()
    {
        $this->table = 'user';
        $this->shardingKey = 'id';
    }

    protected function shardingAlgorithm($key)
    {
        //每张表一千万
        return floor($key / 10000000);
    }
}