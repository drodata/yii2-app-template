<?php

use yii\bootstrap\Html;
use yii\widgets\DetailView;
use drodata\widgets\Box;
use backend\models\Lookup;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = '用户信息';
$this->params = [
    //'title' => $this->title,
    'breadcrumbs' => [
        ['label' => '用户', 'url' => ['index']],
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
                Html::a('删除', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-sm btn-danger',
                    'data' => [
                        'confirm' => '确定删除此条目吗？',
                        'method' => 'post',
                    ],
                ]),
            ],
        ]);?>
        <p>
        </p>

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
                'updated_at:datetime',
                [
                    'attribute' => 'last_logined_at',
                    'value' => $model->readableLastLoginedAt,
                ],
            ],
        ]) ?>

        <?php Box::end();?>
    </div>
</div>
