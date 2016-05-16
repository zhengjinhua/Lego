<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/6
 * Time: 16:07
 */

namespace Plugin\FileUpload;

/**
 * 文件上传类
 * @package Plugin\FileUpload
 */
class File
{
    private $config = [
        'maxSize' => 2097152,       //最大上传大小
        'allowExt' => ['gif', 'jpg', 'jpeg', 'bmp', 'png', 'swf'],//允许的扩展名
        'allowType' => [],          //允许的文件类型
        'savePath' => './upload',   //文件保存路径
    ];

    /**
     * @param array $config
     */
    public function __construct($config)
    {
        if ($config) {
            $this->config = array_merge($this->config, $config);
        }
    }

    /**
     * 上传所有文件
     *
     */
    public function upload()
    {
        $result = [];

        if (!$_FILES) {
            return $result;
        }

        if (!is_dir($this->config['savePath'])) {
            mkdir($this->config['savePath'], 0777, true);
        }

        $files = [];
        if (is_array($_FILES['name'])) {
            foreach ($_FILES as $key => $element) {
                foreach ($element as $key1 => $val) {
                    $files[$key1][$key] = $val;
                }
            }
        } else {
            $files[] = $_FILES;
        }

        $path = $this->config['savePath'] . DIRECTORY_SEPARATOR . date("Y/m/d/H/i/s/");

        foreach ($files as $key2 => $file) {
            if (!empty($file['name'])) {

                $err = 0;
                $errMsg = '';
                $filePath = '';

                $fileInfo = pathinfo($file['name']);
                $file['ext'] = strtolower($fileInfo['name']);

                $checkResult = $this->check($file);
                if ($checkResult === true) {
                    $filePath = $path . md5($file['name']) . $file['ext'];
                    if (!move_uploaded_file($file['tmp_name'], $filePath)) {
                        $err = 1;
                        $errMsg = '文件上传保存错误';
                    }
                } else {
                    $err = 1;
                    $errMsg = $checkResult;
                }

                $result[$file['name']] = ['err' => $err, 'errMsg' => $errMsg, 'path' => $filePath];
            }
        }

        return $result;
    }

    /**
     * 检查文件信息
     * @param $file
     * @return bool|string
     */
    private function check($file)
    {
        if ($file['error'] !== 0) {
            return '文件上传失败';
        }
        //检测文件大小
        if ($file['size'] > $this->config['maxSize']) {
            return '上传文件大小不符';
        }
        //检测文件扩展名
        if (!in_array(strtolower($file['ext']), $this->config['allowExt'], true)) {
            return '上传文件类型不允许';
        }
        // 如果是图像文件 检测文件格式
        if (in_array(strtolower($file['ext']), ['gif', 'jpg', 'jpeg', 'bmp', 'png', 'swf']) &&
            false === getimagesize($file['tmp_name'])
        ) {
            return '非法图像文件';
        }
        //检查文件Mime类型
        if ($this->config['allowType'] &&
            !in_array(strtolower($file['type']), $this->config['allowType'], true)
        ) {
            return '上传文件MIME类型不允许';
        }
        //检测是否非法上传
        if (!is_uploaded_file($file['tmp_name'])) {
            return '非法上传文件';
        }
        return true;
    }

}