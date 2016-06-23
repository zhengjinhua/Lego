<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/20
 * Time: 9:23
 */

namespace Model;

use Core\Model;

class RoleAction extends Model
{

    /**
     * 模型初始化回调
     * @return void
     */
    protected function init()
    {
        $this->table = 'auth_role_action';
    }
}