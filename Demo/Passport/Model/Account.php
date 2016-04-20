<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/9/7
 * Time: 22:45
 */

namespace Model;

use Core\Model;

class Account extends Model
{
    private $tableNum = 20;

    protected function init()
    {
    }

    public function setId($accountId)
    {
        $this->table = 'Account_' . intval($accountId % $this->tableNum);
        return $this;
    }
} 