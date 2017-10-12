<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/20
 * Time: 9:23
 */

namespace Module\Auth\Model;

use Core\Model;
use Core\Config;

class UserRoleModel extends Model
{
    /**
     * @return void
     */
    protected function init()
    {
        $this->config = Config::get('ADMIN_DB');
        $this->table = 'auth_user_role';
    }
}