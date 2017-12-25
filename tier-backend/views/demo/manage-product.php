<?php

use yii\widgets\ListView;
use drodata\helpers\Html;
use drodata\widgets\Box;
use common\models\Lookup;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '临时商品管理';
$this->params = [
    'title' => $this->title,
    'subtitle' => '',
    'breadcrumbs' => [
        ['label' => $this->title, 'url' => 'index'],
        '管理',
    ],
    'buttons' => [
        Html::actionLink(['/lookup/quick-create', 'type' => 'DemoProduct'], [
            'type' => 'button',
            'title' => '新建',
            'icon' => 'plus',
            'color' => 'success',
        ]),
        Html::actionLink('/demo/modal-create-product', [
            'type' => 'button',
            'title' => 'Modal 新建',
            'icon' => 'plus',
            'color' => 'info',
        ]),
    ],
];
?>
<div class="row purchase-index">
    <div class="col-xs-12">
        <?php Box::begin([]);?>
             <?= $this->render('@drodata/views/_button') ?>
             <?= $this->render('/lookup/_grid-quick', [
                 'dataProvider' => $dataProvider,
             ]) ?>
        <?php Box::end();?>
    </div>
</div> <!-- .row -->
