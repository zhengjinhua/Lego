<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/20
 * Time: 9:21
 */

namespace Model;

use Core\Model;

class Role extends Model
{

    protected function init()
    {
        $this->table = 'auth_role';
    }
}