<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/30
 * Time: 9:49
 */
namespace Module\Gii\Controller;

use Util;
//use Core\Router;
use Controller\AdminBase;

class Gii extends AdminBase
{

    public function __construct()
    {
        parent::__construct();
        $this->setLayout('gii');
    }

    public function index()
    {
        //$routeMap = Router::map();
        $this->render('gii/index');
    }

    public function generateModel()
    {
        if (isset($_POST['generate'])) {
            $model = isset($_POST['model']) && !empty($_POST['model']) ? strtolower(trim($_POST['model'])) : '';
            if (!$model) {
                echo json_encode(['error' => 1, 'msg' => '表名不能为空！']);
                exit;
            }

            $modelName = '';
            if (strpos($model, '_') !== false) {
                $arr = explode('_', $model);
                foreach ($arr as $item) {
                    $modelName .= ucfirst($item);
                }
            } else {
                $modelName = ucfirst($model);
            }

            $modelFile = APP_PATH . '/Model/' . $modelName . '.php';
            if (file_exists($modelFile)) {
                echo json_encode(['error' => 2, 'msg' => $modelFile . ' 已存在！']);
                exit;
            }

            if (!is_dir(APP_PATH . '/Model')) {
                mkdir(APP_PATH . '/Model');
            }

            $modelTemplate = dirname(__DIR__) . '/View/templates/model.php';
            if (!file_exists($modelTemplate)) {
                echo json_encode(['error' => 3, 'msg' => '模型模板不存在！']);
                exit;
            }

            $file = file_get_contents($modelTemplate);
            $file = str_replace('tableName', $model, $file);
            $file = str_replace('ModelName', $modelName, $file);

            file_put_contents($modelFile, $file);
            echo json_encode(['error' => 0, 'msg' => 'success']);
            exit;
        }
        $this->render('gii/model');
    }

    public function generateCurd()
    {
        if (isset($_POST['generate'])) {
            $modelClass = isset($_POST['modelClass']) && !empty($_POST['modelClass']) ? trim($_POST['modelClass']) : '';
            $controllerClass = isset($_POST['controllerClass']) && !empty($_POST['controllerClass']) ? trim($_POST['controllerClass']) : '';
            if (!$modelClass || !$controllerClass) {
                echo json_encode(['error' => 1, 'msg' => 'Model Class 和 Controller Class 不能为空！']);
                exit;
            }

            /*if (strpos($modelClass,'Model') === false){
                echo json_encode(['error' => 2,'msg' => '请输入正确的模型名称,eg:GiiModel！']);exit;
            }*/

            if (!preg_match('/Module\/\w+\/Controller\/\w+/', $controllerClass)) {
                echo json_encode(['error' => 3, 'msg' => 'Controller Class 格式错误！eg:Module/Gii/Controller/Gii']);
                exit;
            }

            $controllerTemplate = dirname(__DIR__) . '/View/templates/controller.php';
            if (!file_exists($controllerTemplate)) {
                echo json_encode(['error' => 5, 'msg' => '控制器模板不存在！']);
                exit;
            }

            $controllerArr = explode('/', $controllerClass);
            $moduleName = $controllerArr[1];
            $controllerName = $controllerArr[3];
            $attribute = strtolower(substr($modelClass, 0, strlen($modelClass) - strpos($modelClass, 'Model') - 1));

            $modulePath = APP_PATH . '/Module/' . $moduleName;

            if (!file_exists(APP_PATH . '/Model/' . $modelClass . '.php') && !file_exists($modulePath . '/Model/' . $modelClass . '.php')) {
                echo json_encode(['error' => 4, 'msg' => '请先生成模型！']);
                exit;
            }

            if (!is_dir($modulePath)) {
                $this->generateModule($moduleName, $controllerName);
            }

            $file = file_get_contents($controllerTemplate);
            $file = str_replace('ModuleName', $moduleName, $file);
            $file = str_replace('ControllerName', $controllerName, $file);
            $file = str_replace('ModelName', $modelClass, $file);
            $file = str_replace('attribute', $attribute, $file);

            if (!file_exists($modulePath . '/Controller/' . $controllerName . '.php')) {
                file_put_contents($modulePath . '/Controller/' . $controllerName . '.php', $file);
            }
            $this->generateView($moduleName, $controllerName);

            echo json_encode(['error' => 0, 'msg' => 'success']);
            exit;
        }
        $this->render('gii/curd');
    }

    private function generateModule($moduleName, $controllerName)
    {
        $modulePath = APP_PATH . '/Module/' . $moduleName;
        mkdir($modulePath);
        mkdir($modulePath . '/Controller');
        mkdir($modulePath . '/View');

        $moduleTemplate = dirname(__DIR__) . '/View/templates/module.php';
        if (!file_exists($moduleTemplate)) {
            echo json_encode(['error' => 1001, 'msg' => '模块模板不存在！']);
            exit;
        }

        $file = file_get_contents($moduleTemplate);
        $file = str_replace('ModuleName', $moduleName, $file);
        $file = str_replace('ControllerName', $controllerName, $file);

        if (!file_exists($modulePath . '/Module.php')) {
            file_put_contents($modulePath . '/Module.php', $file);
        }
    }

    private function generateView($moduleName, $controllerName)
    {
        $indexTemplate = dirname(__DIR__) . '/View/templates/indexView.php';
        if (!file_exists($indexTemplate)) {
            echo json_encode(['error' => 1002, 'msg' => 'indexView.php 视图模板不存在！']);
            exit;
        }

        $addTemplate = dirname(__DIR__) . '/View/templates/addView.php';
        if (!file_exists($addTemplate)) {
            echo json_encode(['error' => 1003, 'msg' => 'addView.php 视图模板不存在！']);
            exit;
        }

        $modifyTemplate = dirname(__DIR__) . '/View/templates/modifyView.php';
        if (!file_exists($modifyTemplate)) {
            echo json_encode(['error' => 1004, 'msg' => 'modifyView.php 视图模板不存在！']);
            exit;
        }

        $viewPath = APP_PATH . '/Module/' . $moduleName . '/View/' . $controllerName;
        if (!is_dir($viewPath)) {
            mkdir($viewPath);
        }

        $indexFile = file_get_contents($indexTemplate);
        $indexFile = str_replace('ModuleName', $moduleName, $indexFile);
        $indexFile = str_replace('ControllerName', $controllerName, $indexFile);
        file_put_contents($viewPath . '/index.php', $indexFile);

        $addFile = file_get_contents($addTemplate);
        $addFile = str_replace('ModuleName', $moduleName, $addFile);
        $addFile = str_replace('ControllerName', $controllerName, $addFile);
        file_put_contents($viewPath . '/add.php', $addFile);

        $modifyFile = file_get_contents($modifyTemplate);
        $modifyFile = str_replace('ModuleName', $moduleName, $modifyFile);
        $modifyFile = str_replace('ControllerName', $controllerName, $modifyFile);
        file_put_contents($viewPath . '/modify.php', $modifyFile);
    }

}