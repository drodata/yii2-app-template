<?php

use yii\bootstrap\Html;
use drodata\widgets\Box;
use common\models\Lookup;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = '帐号信息';
$this->params = [
    //'title' => $this->title,
    'breadcrumbs' => [
        //['label' => 'Users', 'url' => ['index']],
        $this->title,
    ],
];
?>
<div class="row user-view">
    <div class="col-md-12 col-lg-8 col-lg-offset-2">
        <?php Box::begin([
            'title' => $this->title,
            'tools' => [
                Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']),
            ],
        ]);?>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'username',
                'screen_name',
                'email:email',
                [
                    'attribute' => 'status',
                    'value' => Lookup::item('UserStatus', $model->status),
                ],
                'group.name',
                [
                    'label' => '职责',
                    'format' => 'raw',
                    'value' => $model->rolesString,
                ],
                'created_at:date',
            ],
        ]) ?>

        <?php Box::end();?>
    </div>
</div>
