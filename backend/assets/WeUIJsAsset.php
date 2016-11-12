<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Asset for https://github.com/progrape/weui.js 
 */
class WeUIJsAsset extends AssetBundle
{
    // Offical package is too old to work with weui 1.0.1
    // we use raw version directly
    //public $sourcePath = '@bower/weui.js/dist/';
    public $basePath = '@webroot';
    public $baseUrl  = '@web';
    public $css = [
    ];
    public $js = [
        'js/weui.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'backend\assets\WeUIAsset',
    ];
}
