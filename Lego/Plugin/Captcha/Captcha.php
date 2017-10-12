<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/10
 * Time: 14:06
 */
namespace Plugin\Captcha;

/**
 * 验证码类
 * @package Plugin\Captcha
 */
class Captcha
{
    private $width;
    private $height;
    private $fontSize;
    private $codeSize;

    private $charset = 'abcdefghkmnprstuvwyzABCDEFGHKLMNPRSTUVWYZ123456789123456789';
    //设置背景色

    private $background = '#EDF7FF';
    //生成验证码字符数

    //验证码
    private $code;

    //图片内存
    private $img;

    function __construct($width = 130, $height = 50, $codeSize = 4)
    {
        $this->width = $width;
        $this->height = $height;
        $this->fontSize = intval($height / 2);
        $this->codeSize = $codeSize;

        $this->font = __DIR__ . '/elephant.ttf';
        //$this->font = __DIR__ . '/WoollyOutline.ttf';
        //$this->font = __DIR__ . '/UniTortred.ttf';
    }

    /**
     * 获取验证码
     */
    public function getCode()
    {
        return strtolower($this->code);
    }

    /**
     * 生成图片
     */
    public function showImage()
    {
        $this->img = imagecreatetruecolor($this->width, $this->height);
        //设置背景色
        $background = imagecolorallocate($this->img, hexdec(substr($this->background, 1, 2)), hexdec(substr($this->background, 3, 2)), hexdec(substr($this->background, 5, 2)));
        imagefilledrectangle($this->img, 0, $this->height, $this->width, 0, $background);

        $this->creatFont();
        $this->creatLine();
        $this->creatLine();
        $this->output();
    }

    /**
     * 生成随机验证码。
     */
    protected function creatCode()
    {
        $code = '';
        $charset_len = strlen($this->charset) - 1;
        for ($i = 0; $i < $this->codeSize; $i++) {
            $code .= $this->charset[rand(1, $charset_len)];
        }
        return $code;
    }

    /**
     * 生成文字
     */
    private function creatFont()
    {
        $this->code = $this->creatCode();

        $x_f = $this->width / $this->codeSize;
        for ($i = 0; $i < $this->codeSize; $i++) {
            $fontColor = imagecolorallocate($this->img, rand(50, 100), rand(50, 100), rand(50, 100));
            $x = $x_f * $i + rand(-($this->fontSize / 4), $this->fontSize / 4);
            $x = $x > 10 ? $x : 10;
            $y = $this->height / 1.4;
            imagettftext($this->img,
                $this->fontSize + rand(-($this->fontSize / 4), $this->fontSize / 4),
                rand(-30, 30),
                $x,
                $y,
                $fontColor,
                $this->font,
                $this->code[$i]);
        }
    }

    /**
     * 画线
     */
    private function creatLine()
    {
        for ($i = 0; $i < $this->codeSize; $i++) {
            imagesetthickness($this->img, rand(1, 2));

            $x_f = $this->width / $this->codeSize;
            $x = $x_f * $i + rand(-10, 10);
            $y = $this->height / 2 - rand(-10, 10);

            $width = rand(10, $this->width / 2);
            $height = rand(5, $this->height);

            $start = rand(0, 300);
            $end = $start + rand(20, 150);
            $end = $end < 360 ? $end : 360;

            $fontColor = imagecolorallocate($this->img, rand(150, 200), rand(150, 200), rand(150, 200));

            imagearc($this->img, $x, $y, $width, $height, $start, $end, $fontColor);
        }
    }

    /**
     * 输出图片
     */
    private function output()
    {
        header("content-type:image/png");
        imagepng($this->img);
        imagedestroy($this->img);
    }
}

