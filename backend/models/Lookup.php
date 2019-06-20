<?php

namespace backend\models;

use Yii;
use drodata\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\base\NotSupportedException;

/**
 * 各个视图内引用的此类而非 drodata\models\Lookup, 目的是可以在这里添加一些
 * application-specific 的静态方法。例如，可以添加一个 customers() 的静态方法，
 * 返回所有客户的 map. 这么做的好处是，不必在视图内再单独引用 Customer 类，
 * 只需引入 Lookup 类即可获取绝大多数的 map。
 */
class Lookup extends \drodata\models\Lookup
{
    /**
     * Logic unit of site/fetch-change-data action
     *
     */
    public static function fetchChangeData($configs)
    {
        $key = ArrayHelper::remove($configs, 'key');
        $id = ArrayHelper::remove($configs, 'id');
        switch ($key) {
            case 'xxx':
                // fill your real code here
                break;
        }
    }

    /**
     * @param array $configs 关系配置数组， 'key' 表示类别
     */
    public static function fetchPrintData($configs)
    {
        $key = ArrayHelper::remove($configs, 'key');
        $section = ArrayHelper::remove($configs, 'section');
        $view = $section ? "/{$key}/_print-{$section}" : "/{$key}/_print";
        $id = ArrayHelper::remove($configs, 'id');

        switch ($key) {
            /** fill your concrete codes here
            case 'exchange':
                $header = '物资调配单';
                $model = Exchange::findOne($id);
                break;
            */
        }

        return Yii::$app->view->render('/site/_print', [
            'header' => $header,
            'content' => Yii::$app->view->render($view, ['model' => $model]),
        ]);
    }
}