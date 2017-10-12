<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/26
 * Time: 17:59
 */

namespace Module\Admin\Model;

use Core\Model;
use Core\Config;

class AdminUserModel extends Model
{
    protected function init()
    {
        $this->config = Config::get('ADMIN_DB');
        $this->table = 'user';
    }

}