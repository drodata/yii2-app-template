<?php

use drodata\helpers\Html;
use drodata\widgets\Box;
use common\models\Lookup;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params = [
    'title' => $this->title,
    'subtitle' => '',
    'breadcrumbs' => [
        ['label' => $this->title, 'url' => 'index'],
        '管理',
    ],
];
?>
<div class="row user-index">
    <div class="col-sm-12">
        <?php Box::begin([
            'title' => $this->title,
            'tools' => [
            ],
        ]);?>
            <div class="operation-group">
                <?= Html::a('新建', ['create'], [
                    'class' => 'btn btn-sm btn-success',
                    'visible' => true,
                ]) ?>
            </div>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                /* `afterRow` has the same signature
                'rowOptions' => function ($model, $key, $index, $grid) {
                     return [
                         'class' => ($model->status == Product::DISABLED) ? 'bg-danger' : '',
                     ];
                },
                */
                'filterModel' => $searchModel,
               'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'username',
                    'screen_name',
                    'group_id',
                    'auth_key',
                    // 'password_hash',
                    // 'password_reset_token',
                    // 'email:email',
                    // 'status',
                    // 'created_by',
                    // 'updated_by',
                    // 'created_at',
                    // 'updated_at',
                    // 'last_logined_at',

                    /*
                    [
                        'attribute' => 'status',
                        'filter' => Lookup::items('UserStatus'),
                        'value' => function ($model, $key, $index, $column) {
                            return Lookup::item('UserStatus', $model->status);
                        },
                        'contentOptions' => ['width' => '80px'],
                    ],
                    [
                        'label' => '',
                        'format' => 'raw',
                        'value' => function ($model, $key, $index, $column) {
                            return $model->rolesString;
                        },
                    ],
                    */
                    [
                        'class' => 'drodata\grid\ActionColumn',
                        'template' => '{view} {update} {delete}',
                        'contentOptions' => [
                            'style' => 'min-width:80px',
                            'class' => 'text-center',
                        ],
                        'buttons' => [
                            // cutom button template
                            '' => function ($url, $model, $key) {
                                return Html::iconLink('eye', ['/order/view', 'id' => $model->id], [
                                    'title' => '',
                                    'mutedTitle' => '',
                                    'visible' => true,
                                    'muted' => false,
                                ]);
                            },
                        ],
                    ],
                ],
            ]); ?>
        <?php Box::end();?>
    </div>
</div> <!-- .row -->
