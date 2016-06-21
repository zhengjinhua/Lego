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

    /**
     *
     * @param int $key
     * @return int
     */
    protected function shardingAlgorithm($key)
    {
        switch ($key) {
            case $key > 0 && $key <= 10000000:
                $table = 1;
                break;
            default:
                $table = 0;
        }
        return $table;
    }
}