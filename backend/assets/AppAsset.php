<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 *
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl  = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
        'js/jquery.trekshot.js',
        'js/ajax-operations.js',
    ];
    public $depends = [
        'drodata\assets\AdminLTECustomAsset',
    ];

    public function init()
    {
        parent::init();

        // protect frequent changed assets from cached in browser
        foreach (['css', 'js'] as $prop) {
            for ($i = 0; $i < count($this->$prop); $i++) {
                $hash = substr(md5_file($this->basePath . '/' . $this->{$prop}[$i]), 0, 10);
                $this->{$prop}[$i] .= '?v=' . $hash;
            }
        }
    }
}
