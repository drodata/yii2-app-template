<?php

namespace common\weui;

/**
 * echo Message::widget([
 *     'icon' => Html::icon('success', ['class' => 'icon-lg']),
 *     'title' => '订单已确认',
 *     'desc' => '您可以继续新建订单' . Html::a('新建订单', '#'),
 *     'buttons' => [
 *         Html::button('继续确认', ['class' => 'btn btn-success']),
 *         Html::a('返回首页', '#', ['class' => 'btn btn-default']),
 *     ],
 *     'footerLink' => Html::a('返回首页', '#', ['class' => '']),
 *     'footerText' => 'kuaifa.com.au',
 * ]);
 */
class Message extends \yii\base\Widget
{
    public $icon;
    public $title;
    public $desc = '';
    public $buttons = [];
    public $footerLink = '';
    public $footerText = '';

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $opt  = Html::beginTag('div', ['class' => 'weui-msg']);

        // header
        $opt  .= Html::tag('div', $this->icon, ['class' => 'weui-msg__icon-area']);
        $opt  .= Html::beginTag('div', ['class' => 'weui-msg__text-area']);
        $opt  .= Html::tag('h2', $this->title, ['class' => 'weui-msg__title']);
        $opt  .= Html::tag('div', $this->desc, ['class' => 'weui-msg__desc']);
        $opt  .= Html::endTag('div');
        
        // operation area
        $opt  .= Html::beginTag('div', ['class' => 'weui-msg__opr-area']);
        $opt  .= Html::beginTag('div', ['class' => 'weui-btn-area']);
        if (count($this->buttons) > 0) {
            foreach ($this->buttons as $btn) {
                $opt .= $btn;
            }
        }
        $opt  .= Html::endTag('div');
        $opt  .= Html::endTag('div');

        // extra-area
        $opt  .= Html::beginTag('div', ['class' => 'weui-msg__extra-area']);
        $opt  .= Html::beginTag('div', ['class' => 'weui-footer']);
        $opt  .= empty($this->footerLink) ? '' : Html::tag('p', $this->footerLink, ['class' => 'weui-weui-footer__links']);
        $opt  .= empty($this->footerText) ? '' : Html::tag('p', $this->footerText, ['class' => 'weui-weui-footer__text']);
        $opt  .= Html::endTag('div');
        $opt  .= Html::endTag('div');

        return $opt;
    }
}
