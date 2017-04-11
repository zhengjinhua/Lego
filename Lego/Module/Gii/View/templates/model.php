<?php

namespace Model;

use Core\Model;

class ModelNameModel extends Model
{
    protected function init()
    {
        $this->table = 'tableName';
    }
}