<?php

namespace backend\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AdminLTEAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/dist/';
    public $js = ['js/app.js'];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'drodata\assets\FontAwesomeAsset',
    ];
    private $_css;

    protected function getCss()
    {
        return $this->_css;
    }
    protected function setCss($arr)
    {
        $this->_css = $arr;

    }

    public function init()
    {
        $this->css = [
            'css/AdminLTE.css',
            'css/skins/skin-' . Yii::$app->params['skin'] . '.css',
        ];

        parent::init();
    }
}
