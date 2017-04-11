<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/10
 * Time: 14:06
 */
namespace Module\Admin\Plugin\MenuActive;

use Core\Event;
use Core\Config;
use Core\PluginInterface;

/*
Config::set('MENU', [
    '设置' => [
        'icon' => 'fa-tasks',
        'submenu' => [
            '帐号管理' => [
                'path' => '\Module\Admin\Controller\User::index',
                'ext' => [
                    '\Module\Admin\Controller\User::detail',
                    '\Module\Admin\Controller\User::',
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

            if (!$callback) {
                return;
            }

            if (!isset($_SESSION['auth'])) {
                return;
            }

            if (!isset($_SESSION['menu'])) {
                $menu = Config::get('MENU');
                $authExcludedAction = Config::get('AUTH_EXCLUDED_ACTION');
                $authExcluded = isset($authExcludedAction) ? $authExcludedAction : [];
                $userAuth = isset($_SESSION['auth']) ? $_SESSION['auth'] : [];
                $userAllAuth = array_unique(array_merge($authExcluded, $userAuth));

                foreach ($menu as $k => $v) {
                    foreach ($v['submenu'] as $kk => $vv) {
                        if (!in_array($vv['path'], $userAllAuth)) {
                            unset($menu[$k]['submenu'][$kk]);
                        }
                    }
                    if (empty($menu[$k]['submenu'])) {
                        unset($menu[$k]);
                    }
                }
                $_SESSION['menu'] = $menu;
            }

            $menu = $_SESSION['menu'];

            //$menu = Config::get('MENU');
            $findActive = false;
            if (is_array($menu)) {
                foreach ($menu as &$group) {
                    foreach ($group['submenu'] as &$menuItem) {
                        if ($menuItem['path'] === $callback) {
                            $menuItem['active'] = 1;
                            $findActive = true;
                        }
                        if (!$findActive) {
                            foreach ($menuItem['ext'] as $extPath) {
                                if (strpos($callback, $extPath) !== false) {
                                    $menuItem['active'] = 1;
                                    $findActive = true;
                                    break;
                                }
                            }
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