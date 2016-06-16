<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/10
 * Time: 14:06
 */
namespace Plugin\MenuActive;

use Core\Event;
use Core\Config;
use Core\PluginInterface;

/*
Config::set('MENU', [
    '设置' => [
        'icon' => 'fa-tasks',
        'submenu' => [
            '帐号管理' => [
                'path' => '\Module\Account\Controller\User::index',
                'ext' => [
                    '\Module\Account\Controller\User::detail',
                    '\Module\Account\Controller\User::add',
                    '\Module\Account\Controller\User::update'
                ]
            ],
        ]
    ]
]);
 */

/**
 * 菜单焦点
 *
 * @package Plugin
 */
class Plugin implements PluginInterface
{
    public static function register()
    {
        //AFTER_ROUTE阶段检测静态化需求
        Event::attach('CORE.ROUTE.POST', function ($callback) {
            $menu = Config::get('MENU');
            $findActive = false;
            if (is_array($menu)) {
                foreach ($menu as &$group) {
                    foreach ($group['submenu'] as &$menuItem) {
                        if ($menuItem['path'] === $callback) {
                            $menuItem['active'] = 1;
                            $findActive = true;
                        }
                        if (!$findActive && in_array($callback, $menuItem['ext'])) {
                            $menuItem['active'] = 1;
                            $findActive = true;
                        }
                        if (isset($menuItem['active'])) {
                            $group['active'] = 1;
                            break 2;
                        }
                    }
                }
                Config::set('MENU', $menu);
            }
        });
    }
}