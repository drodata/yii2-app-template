<?php

use drodata\helpers\Html;
use yii\grid\GridView;
use drodata\widgets\Box;
use common\models\Lookup;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LookupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lookups';
$this->params = [
    'title' => $this->title,
    'breadcrumbs' => [
        ['label' => $this->title, 'url' => 'index'],
        '管理',
    ],
];
?>
<div class="row lookup-index">
    <div class="col-sm-12">
        <?php Box::begin([
            'title' => $this->title,
            'tools' => [
                Html::a('新建 Lookup', ['create'], ['class' => 'btn btn-sm btn-success'])
            ],
        ]);?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
               'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'name',
                    'code',
                    'type',
                    'position',

                    /*
                    [
                        'attribute' => 'status',
                        'filter' => Lookup::items('UserStatus'),
                        'value' => function ($model, $key, $index, $column) {
                            return Lookup::item('UserStatus', $model->status);
                        },
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
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{update}',
                        'buttons' => [
                            'update' => function ($url, $model, $key) {
                                return Html::a(Html::icon('pencil'), ['update', 'id' => $model->id],[
                                    'title' => '修改',
                                ]);
                            },
                        ],
                    ],
                ],
            ]); ?>
        <?php Box::end();?>
    </div>
</div> <!-- .row -->
