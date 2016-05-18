<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/9/7
 * Time: 22:45
 */

namespace Model;

use Core\Model;

class UserIndexUsername extends Model
{
    protected function init()
    {
        $this->table = 'user_index_username';
    }
}