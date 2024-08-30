<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace nt\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
        'js/ajax-operations.js',
    ];
    public $depends = [
        'drodata\assets\AdminLTECustomAsset',
        'drodata\trekshot\TrekshotAsset',
        'drodata\jqprint\PrintAsset',
        'drodata\assets\GenericModelAsset',
        'drodata\assets\BackendUexAsset',
    ];
}
