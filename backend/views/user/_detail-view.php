<?php

use yii\helpers\Html;
use yii\bootstrap\BaseHtml;
use common\widgets\Box;
use commom\models\Lookup;
use yii\widgets\DetailView;

/* @var $model common\models\User */

?>
<?php Box::begin([
    'title' => $model->id,
]);?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'screen_name',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email:email',
            'status',
            'group_id',
            'created_at',
            'updated_at',
            'last_login_at',
            'created_by',
            'updated_by',
            'owned_by',
            'note:ntext',
        ],
    ]) ?>
<?php Box::end();?>
