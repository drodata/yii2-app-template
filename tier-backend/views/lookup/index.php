<?php

use yii\widgets\ListView;
use drodata\helpers\Html;
use drodata\widgets\Box;
use common\models\Lookup;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LookupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lookups';
$this->params = [
    'title' => $this->title,
    'subtitle' => '',
    'breadcrumbs' => [
        ['label' => $this->title, 'url' => 'index'],
        '管理',
    ],
];

// operation buttons
$buttons = [
    Html::actionLink('/lookup/create', [
        'type' => 'button',
        'title' => '新建',
        'icon' => 'plus',
        'color' => 'success',
    ]),
];
?>
<div class="row lookup-index">
    <!-- hide on phone -->
    <div class="col-xs-12 hidden-xs">
        <?php Box::begin([
            'title' => $this->title,
            'tools' => [],
        ]);?>
             <?= $this->render('_button', ['buttons' => $buttons]) ?>
             <?= $this->render('_grid', [
                 'searchModel' => $searchModel,
                 'dataProvider' => $dataProvider,
             ]) ?>
        <?php Box::end();?>
    </div>
    <!-- visible on phone -->
    <div class="col-xs-12 visible-xs-block">
        <?= $this->render('_button', ['buttons' => $buttons]) ?>
        <?= $this->render('_search', [
            'model' => $searchModel,
        ]) ?>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'options' => ['class' => 'row'],
            'itemOptions' => ['class' => 'col-xs-12'],
            'summaryOptions' => ['class' => 'col-xs-12'],
            'emptyTextOptions' => ['class' => 'col-xs-12'],
            'layout' => "{summary}\n{items}\n<div class=\"col-xs-12\">{pager}</div>",
            'pager' => ['maxButtonCount' => 5],
            'itemView' => '_list-view',
        ]) ?>
    </div>
</div> <!-- .row -->
