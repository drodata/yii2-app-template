<?php

namespace common\weui;

use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\BaseHtml;

class Html extends BaseHtml
{

    /**
     * Convert Bootstrap-flavored class name to WeUI button class name
     *
     * @param string $className
     * @param string $type: 'button' or 'link'
     * @return string
     */
    public static function replaceClass($className, $type)
    {
        $isButtonStyle = ($type == 'button' || strpos($className, 'btn-') != false);
        $map = [
            'btn-success' => 'weui-btn_primary',
            'btn-danger' => 'weui-btn_warn',
            'btn-default' => 'weui-btn_default',
            'btn-mini' => 'weui-btn_mini',
            'disabled' => 'weui-btn_disabled',
        ];
        foreach ($map as $key => $value) {
            //!!!
            $className = str_replace($key, $value, $className);
        }

        $slices = explode(' ', $className);
        for ($i =0; $i < count($slices); $i++) {
            $slices[$i] = trim($slices[$i]);
        }
        //!!!
        if (($key = array_search('btn', $slices)) !== false) {
            unset($slices[$key]);
        }

        if ($isButtonStyle) {
            array_push($slices, 'weui-btn');
        }

        return implode(' ', $slices);
    }

    /**
     * .icon-lg, .text-info | success ...
     */
    public static function icon($name, $options = [])
    {
        $nameMap = [
            'success' => 'weui-icon-success',
            'info' => 'weui-icon-info',
            'search' => 'weui-icon-search',
            'waiting' => 'weui-icon-waiting',
            'cancel' => 'weui-icon-cancel',
            'circle' => 'weui-icon-circle',
            'warn' => 'weui-icon-warn',
            'download' => 'weui-icon-download',
            'clear' => 'weui-icon-clear',
        ];

        static::addCssClass($options, $nameMap[$name]);
        return static::tag('i', '', $options);
    }

    /**
     * Add the special `visible` attribute
     */
    public static function a($text, $url = null, $options = [])
    {
        $class = ArrayHelper::remove($options, 'class');
        $options = ArrayHelper::merge($options, [
            'class' => static::replaceClass($class, 'link'),
        ]);

        if ($url !== null) {
            $options['href'] = Url::to($url);
        }
        $visible = ArrayHelper::remove($options, 'visible', true);
        
        return $visible ? static::tag('a', $text, $options) : '';
    }

    /**
     * Add the special `visible` attribute
     * Bootstap Flavor class name
     */

    public static function button($content = 'Button', $options = [])
    {
        $class = ArrayHelper::remove($options, 'class');
        $options = ArrayHelper::merge($options, [
            'class' => static::replaceClass($class, 'button'),
        ]);
        if (!isset($options['type'])) {
            $options['type'] = 'button';
        }
        $visible = ArrayHelper::remove($options, 'visible', true);
        return $visible ? static::tag('button', $content, $options) : '';
    }
}
