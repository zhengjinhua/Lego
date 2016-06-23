<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/20
 * Time: 9:21
 */

namespace Model;

use Core\Model;

class Action extends Model
{


    /**
     * @return void
     */
    protected function init()
    {
        $this->table = 'auth_action';
    }
}
