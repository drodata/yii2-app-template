<?php

use yii\widgets\DetailView;
use drodata\helpers\Html;
use drodata\widgets\Box;
use common\models\Lookup;

/* @var $this yii\web\View */
/* @var $model backend\models\Lookup */

$this->title = $model->name;
$this->params = [
    'title' => '详情',
    //'subtitle' => '#' . $model->id,
    'breadcrumbs' => [
        ['label' => 'Lookups', 'url' => ['index']],
        $this->title,
    ],
];
?>
<div class="row lookup-view">
    <div class="col-md-12 col-lg-6 col-lg-offset-3">
        <?php Box::begin([
            'title' => $this->title,
            'tools' => [],
        ]);?>
        <?= $this->render('_detail-action', ['model' => $model])?>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'name',
                'code',
                'type',
                'position',
                'visible',
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
