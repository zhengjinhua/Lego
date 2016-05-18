<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/9/7
 * Time: 22:45
 */

namespace Model;

use Core\Model;

class Uniqueid extends Model
{
    protected function init()
    {
    }

    public function generate()
    {
        $this->exec('REPLACE INTO `uniqueid` SET `flag` = 1');
        return $this->lastInsertId();
    }
} 