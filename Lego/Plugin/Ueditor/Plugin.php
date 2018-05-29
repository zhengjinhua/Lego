<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/10
 * Time: 14:06
 */

namespace Plugin\Ueditor;

use Core\Event;
use Core\Router;
use Core\PluginInterface;

/**
 * 系统初始化插件
 *
 * @package Plugin\SystemInit
 */
class Plugin implements PluginInterface
{
    public static function register()
    {
        Event::attach("CORE.ROUTE.PRE", function () {

            Router::mixed('/ueditor', function () {
                //header('Access-Control-Allow-Origin: http://www.baidu.com'); //设置http://www.baidu.com允许跨域访问
                //header('Access-Control-Allow-Headers: X-Requested-With,X_Requested_With'); //设置允许的跨域header APP_PATH .DIRECTORY_SEPARATOR."Plugin".DIRECTORY_SEPARATOR."config.json"

                $config = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents(__DIR__ . "/config.json")), true);

                $action = $_GET['action'];

                switch ($action) {
                    case 'config':
                        $result = json_encode($config);
                        break;

                    /* 上传图片 */
                    case 'uploadimage':
                        /* 上传涂鸦 */
                    case 'uploadscrawl':
                        /* 上传视频 */
                    case 'uploadvideo':
                        /* 上传文件 */
                    case 'uploadfile':
                        $uploadFile = new action_upload();
                        $result = $uploadFile->init($config, $action);
                        break;

                    /* 列出图片 */
                    case 'listimage':
                        $listImage = new action_list();
                        $result = $listImage->init($config, $action);
                        break;
                    /* 列出文件 */
                    case 'listfile':
                        $listImage = new action_list();
                        $result = $listImage->init($config, $action);
                        break;

                    /* 抓取远程文件 */
                    case 'catchimage':
                        $catchImage = new action_crawler();
                        $result = $catchImage->init($config);
                        break;

                    default:
                        $result = json_encode(array(
                            'state' => '请求地址出错'
                        ));
                        break;
                }
                /* 输出结果 */
                if (isset($_GET["callback"])) {
                    if (preg_match("/^[\w_]+$/", $_GET["callback"])) {
                        echo $_GET["callback"] . '(' . $result . ')';
                    } else {
                        echo json_encode(array(
                            'state' => 'callback参数不合法'
                        ));
                    }
                } else {
                    echo $result;
                }
            });
        });
    }
}