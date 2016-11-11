<?php

namespace common\weui;

use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\BaseHtml;

class Html extends BaseHtml
{

    /**
     * Add the special `visible` attribute
     */
    public static function button($content = 'Button', $options = [])
    {
        $map = [
            'btn-primary' => 'weui-btn_primary',
            'btn-danger' => 'weui-btn_warn',
            'btn-default' => 'weui-btn_default',
            'btn-xs' => 'weui-btn_mini',
        ];
        $class = ArrayHelper::remove($options, 'class');
        foreach ($map as $key => $value) {
            //!!!
            $class = str_replace($key, $value, $class);
        }
        $names = explode(' ', $class);

        //!!!
        if (($key = array_search('btn', $names)) !== false) {
            unset($names[$key]);
        }
        array_push($names, 'weui-btn');
        $options = ArrayHelper::merge($options, [
            'class' => implode(' ', $names),
        ]);

        if (!isset($options['type'])) {
            $options['type'] = 'button';
        }
        $visible = ArrayHelper::remove($options, 'visible', true);
        return $visible ? static::tag('button', $content, $options) : '';
    }
}
