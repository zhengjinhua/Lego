<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/20
 * Time: 9:21
 */

namespace Module\Auth\Model;

use Core\Model;
use Core\Config;

class RoleModel extends Model
{

    protected function init()
    {
        $this->config = Config::get('ADMIN_DB');
        $this->table = 'auth_role';
    }
}