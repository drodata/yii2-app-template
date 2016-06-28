<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/dist/';
    public $css = [
        'css/AdminLTE.css',
        'css/skins/skin-blue.css',
    ];
    public $js = ['js/app.js'];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
