<?php

namespace common\weui;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

/**
 */
class Panel extends \yii\base\Widget
{
    public $title = '';
    public $footerButtons = [];
    public $items = [];

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $opt  = Html::beginTag('div', ['class' => 'weui-panel']);
        $opt  .= Html::tag('div', $this->title, ['class' => 'weui-panel__hd']);

        // body
        $opt  .= Html::beginTag('div', ['class' => 'weui-panel__bd']);
        
        $opt .= $this->renderItems();

        $tail = Html::endTag('div'); // .weui-panel__bd 
        if (!empty($this->footer)) {
            $tail  .= Html::tag('div', $this->footer, ['class' => 'weui-panel__ft']);
        }
        $tail .= Html::endTag('div'); // .weui-panel ends

        $opt .= $tail;

        return $opt;
    }

    public function renderFooter()
    {
        if (count($this->footerButtons) > 0) {
            return Html::tag('div', implode("\n", $this->footerButtons), ['class' => 'weui-form-preview__ft']);
        }
    }
    public function renderItems()
    {
        $items = [];
        foreach ($this->items as $i => $item) {
            if (isset($item['visible']) && !$item['visible']) {
                continue;
            }
            $items[] = $this->renderItem($item);
        }

        $footer = $this->renderFooter();

        return implode("\n", $items) . $footer;
    }

    public function renderItem($item)
    {
        if (!isset($item['type'])) {
            throw new InvalidConfigException("The 'type' option is required.");
        }
        $type = ArrayHelper::getValue($item, 'type');
        $title = ArrayHelper::getValue($item, 'title');
        $desc = ArrayHelper::getValue($item, 'desc', '');
        $src = ArrayHelper::getValue($item, 'src', false);
        $url = ArrayHelper::getValue($item, 'url', 'javascript:void(0);');
        $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);

        switch ($type) {
            case 'thumbnail':
                $inner  = Html::beginTag('div', [ 'class' => 'weui-media-box__hd' ]);
                $inner .=   Html::img($src, ['class' => 'weui-media-box__thumb']);
                $inner .= Html::endTag('div');
                $inner .= Html::beginTag('div', [ 'class' => 'weui-media-box__bd' ]);
                $inner .=   Html::tag('h4', $title, ['class' => 'weui-media-box__title']);
                $inner .=   Html::tag('p', $desc, ['class' => 'weui-media-box__desc']);
                $inner .= Html::endTag('div');

                $class = 'weui-media-box weui-media-box_appmsg';
                break;
            case 'text':
                $inner  =   Html::tag('h4', $title, ['class' => 'weui-media-box__title']);
                $inner .=   Html::tag('p', $desc, ['class' => 'weui-media-box__desc']);

                $class = 'weui-media-box weui-media-box_text';
                break;
            case 'icon':
                $inner  = Html::beginTag('div', [ 'class' => 'weui-cell__hd' ]);
                $inner .=   Html::img($src, ['style' => 'width:20px;margin-right:5px;display:block']);
                $inner .= Html::endTag('div');
                $inner .= Html::beginTag('div', [ 'class' => 'weui-cell__bd weui-cell_primary' ]);
                $inner .=   Html::tag('p', $title);
                $inner .= Html::endTag('div');
                $inner .= Html::tag('span', '', ['class' => 'weui-cell__ft']);

                $class = 'weui-cell weui-cell_access';
                break;
        }

        if ($type != 'text') {
            Html::addCssClass($linkOptions, $class);
        }

        return $type == 'text' 
            ? Html::tag('div', $inner, [ 'class' => $class, ])
            : Html::a($inner, $url, $linkOptions);
    }
}

