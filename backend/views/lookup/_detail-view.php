<?php

use yii\widgets\DetailView;
use drodata\helpers\Html;
use backend\models\Lookup;

/* @var $model backend\models\Lookup */

?>
    <?= DetailView::widget([
        'model' => $model,
        'template' => Html::beginTag('tr')
            . Html::tag('th', '{label}', ['width' => '30%', 'class' => 'text-right'])
            . Html::tag('td', '{value}')
            . Html::endTag('td'),
        'attributes' => [
            'id',
            'name',
            'code',
            'type',
            'position',
            'visible',
        ],
    ]) ?>
