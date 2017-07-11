<?php

use yii\widgets\DetailView;
use drodata\helpers\Html;
use backend\models\Lookup;

/* @var $model backend\models\User */

?>
    <?= DetailView::widget([
        'model' => $model,
        'template' => Html::beginTag('tr')
            . Html::tag('th', '{label}', ['width' => '30%', 'class' => 'text-right'])
            . Html::tag('td', '{value}')
            . Html::endTag('td'),
        'attributes' => [
            'id',
            'username',
            'screen_name',
            'group_id',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email:email',
            'status',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
            'last_logined_at',
        ],
    ]) ?>
