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

class ActionModel extends Model
{
    /**
     * @return void
     */
    protected function init()
    {
        $this->table = 'auth_action';
    }
}