<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/9/7
 * Time: 22:45
 */

namespace Module\Account\Model;

use Core\Model;

class AccountUsernameIndex extends Model
{
    protected function init()
    {
        $this->table = 'account_username_index';
    }
}