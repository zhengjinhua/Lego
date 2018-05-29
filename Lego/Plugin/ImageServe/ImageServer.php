<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/6
 * Time: 16:07
 */

namespace Plugin\ImageServe;

use Core\Config;

/**
 * 文件上传类
 * @package Plugin\FileUpload
 */
class ImageServer
{
    public function __construct()
    {
        $this->config = Config::get('IMAGE_SERVE_CONFIG');
    }

    /**
     * 上传所有文件
     *
     */
    public function uploadFile()
    {
        $result = [];

        if (!$_FILES || !$_FILES['file']) {
            return $result;
        }

        //处理多个文件
        $files = [];
        if (is_array($_FILES['file']['name'])) {
            foreach ($_FILES['file'] as $key => $element) {
                foreach ($element as $key1 => $val) {
                    $files[$key1][$key] = $val;
                }
            }
        } else {
            $files[] = $_FILES['file'];
        }

        if ($this->config['storage'] === 'ftp') {
            $result = $this->ftpSave($files);
        } else {
            $result = $this->localSave($files);
        }
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    private function localSave($files)
    {
        //创建保存目录
        $path = date("/Y/md/");
        if (!is_dir($this->config['savePath'] . $path)) {
            mkdir($this->config['savePath'] . $path, 0777, 1);
        }

        //保存文件
        foreach ($files as $key2 => $file) {
            if (!empty($file['name'])) {

                $err = 0;
                $errMsg = '';
                $filePath = $savePath = $showPath = '';

                $fileInfo = pathinfo($file['name']);
                $file['ext'] = strtolower($fileInfo['extension']);

                $checkResult = $this->check($file);
                if ($checkResult === true) {

                    $filePath = $path . md5(time() . $file['name']) . '.' . $file['ext'];
                    $savePath = $this->config['savePath'] . $filePath;
                    $showPath = $this->config['showPath'] . $filePath;

                    if (!move_uploaded_file($file['tmp_name'], $savePath)) {
                        $err = 1;
                        $errMsg = '文件上传保存错误';
                        $filePath = $savePath = $showPath = '';
                    }
                } else {
                    $err = 1;
                    $errMsg = $checkResult;
                }

                $result[$key2] = ['err' => $err, 'errMsg' => $errMsg, 'showPath' => $showPath];
            }
        }

        return $result;
    }

    private function ftpSave($files)
    {
        $ftp = Ftp::instance();

        $path = date("/Y/md/");

        //保存文件
        foreach ($files as $key2 => $file) {
            if (!empty($file['name'])) {

                $err = 0;
                $errMsg = '';
                $filePath = $savePath = $showPath = '';

                $fileInfo = pathinfo($file['name']);
                $file['ext'] = strtolower($fileInfo['extension']);

                $checkResult = $this->check($file);
                if ($checkResult === true) {

                    $filePath = $path . md5(time() . $file['name']) . '.' . $file['ext'];
                    $savePath = $this->config['savePath'] . $filePath;
                    $showPath = $this->config['showPath'] . $filePath;;
                    if (!$ftp->upload($file['tmp_name'], $savePath)) {
                        $err = 1;
                        $errMsg = '文件上传保存错误';
                        $filePath = $savePath = $showPath = '';
                    }
                } else {
                    $err = 1;
                    $errMsg = $checkResult;
                }

                $result[$key2] = ['err' => $err, 'errMsg' => $errMsg, 'showPath' => $showPath];
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

        //检测是否非法上传
        if (!is_uploaded_file($file['tmp_name'])) {
            return '非法上传文件';
        }

        return true;
    }

}