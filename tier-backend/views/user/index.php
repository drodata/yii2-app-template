<?php

use yii\bootstrap\Html;
use yii\grid\GridView;
use common\widgets\Box;
use backend\models\Lookup;
use backend\models\UserGroup;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户';
$this->params = [
    'title' => $this->title,
    'breadcrumbs' => [
        ['label' => $this->title, 'url' => 'index'],
        '管理',
    ],
];
?>
<div class="row user-index">
    <div class="col-sm-12">
       <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <p>
            <?= Html::a('新建用户', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <?php Box::begin([
            'title' => $this->title,
        ]);?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
               'columns' => [
                    [
                        'attribute' => 'created_at',
                        'format' => 'datetime',
                        'contentOptions' => ['style' => 'width:180px'],
                        'filter' => DateRangePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'created_at',
                        ])
                    ],
                    'id',
                    'username',
                    'screen_name',
                    [
                        'attribute' => 'status',
                        'filter' => Lookup::items('UserStatus'),
                        'value' => function ($model, $key, $index, $column) {
                            return Lookup::item('UserStatus', $model->status);
                        },
                    ],
                    [
                        'attribute' => 'group_id',
                        'filter' => UserGroup::map(),
                        'value' => function ($model, $key, $index, $column) {
                            return $model->group->name;
                        },
                    ],
                    // 'created_at',
                    // 'updated_at',
                    // 'last_logined_at',
                    // 'created_by',
                    // 'updated_by',
                    // 'owned_by',
                    // 'note:ntext',

                    /*
                    [
                        'label' => '',
                        'format' => 'raw',
                        'value' => function ($model, $key, $index, $column) {
                            return $model->rolesString;
                        },
                    ],
                    */
                    ['class' => 'drodata\grid\ActionColumn'],
                    /*
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {delete} {}',
                        'buttons' => [
                            '' => function ($url, $model, $key) {
                                return BaseHtml::a(BaseHtml::icon(''), ['/order/view', 'id' => $model->id],[
                                    'title' => '',
                                    'data' => [
                                        'id' => $model->id,
                                    ],
                                ]);
                            },
                        ],
                    ],
                    */
                ],
            ]); ?>
        <?php Box::end();?>
    </div>
</div> <!-- .row -->
