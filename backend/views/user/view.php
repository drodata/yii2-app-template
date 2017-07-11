<?php

use yii\widgets\DetailView;
use drodata\helpers\Html;
use drodata\widgets\Box;
use common\models\Lookup;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->id;
$this->params = [
    'title' => '详情',
    //'subtitle' => '#' . $model->id,
    'breadcrumbs' => [
        ['label' => 'Users', 'url' => ['index']],
        $this->title,
    ],
];
?>
<div class="row user-view">
    <div class="col-md-12 col-lg-6 col-lg-offset-3">
        <?php Box::begin([
            'title' => $this->title,
            'tools' => [
                Html::a(Html::icon('pencil'), ['update', 'id' => $model->id], [
                    'class' => 'btn btn-sm btn-primary',
                    'title' => '修改',
                ]),
                Html::a(Html::icon('trash'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-sm btn-danger',
                    'title' => '删除',
                    'data' => [
                        'confirm' => '确定删除此条目吗？',
                        'method' => 'post',
                    ],
                ]),
            ],
        ]);?>
        <?= DetailView::widget([
            'model' => $model,
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
                /*
                [
                    'attribute' => 'status',
                    'value' => Lookup::item('UserStatus', $model->status),
                ],
                */
            ],
        ]) ?>

        <?php Box::end();?>
    </div>
</div>
