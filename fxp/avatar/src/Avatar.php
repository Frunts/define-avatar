<?php
/**
 * @IDE: VS code 
 * @created_at: 2019-09-16 14:41 
 * @author: Fxp
 * 
 */
namespace Fxp\Avatar;

use Illuminate\Config\Repository;

class Avatar
{

    protected $config;
    /**
     * Constructer
     */
    public function __construct(Repository $config)
    {
        $this->config = $config->get('avatar');
    }

    private function generate($name)
    {
        //创建图片资源
        $img_res = imagecreate($this->config['width'], $this->config['height']);
        //背景颜色
        $bg_color = imagecolorallocate($img_res, mt_rand(120, 190), mt_rand(120, 190), mt_rand(120, 190));
        //字体颜色
        $ft_color = imagecolorallocate($img_res, mt_rand(190, 255), mt_rand(190, 255), mt_rand(190, 255));
        //填充背景色
        imagefill($img_res, 1, 1, $bg_color);
        //计算文字的宽高
        $pos = imagettfbbox($this->config['font_size'], 0, $this->config['font_file'], mb_substr($name, 0, 1));
        $font_width = $pos[2] - $pos[0] + 0.32 * $this->config['font_size'];
        $font_height = $pos[1] - $pos[5] + -0.16 * $this->config['font_size'];
        //写入文字
        imagettftext($img_res, $this->config['font_size'], 0, ($this->config['width'] - $font_width)/2, ($this->config['height'] - $font_height)/2 + $font_height, $ft_color, $this->config['font_file'], mb_substr($name, 0, 1));
        return $img_res;
    }

    public function output($name, $path = false)
    {
        $img_res = $this->generate($name);
        // 确定输出类型和生成用的方法名
        $content_type = 'image/' . $this->config['type'];
        $generateMethodName = 'image' . $this->config['type'];
        // 确定是否输出到浏览器
        if(!$path){
            header("Content-type: " . $content_type);
            $generateMethodName($img_res);
        } else {
            $generateMethodName($img_res, $path);
        }
        // 释放图片内存
        imagedestroy($img_res);
    }

}