<?php
use drodata\helpers\Html;
use drodata\widgets\Box;
use \common\widgets\ChartJs;

/* @var $this yii\web\View */

$this->title = 'Chart.js';
$this->params = [
    'title' => $this->title,
    'breadcrumbs' => [
        ['label' => 'Index', 'url' => 'index'],
        $this->title,
    ],
];

?>
<div class="row">
    <div class="col-lg-8 col-md-12">
        <?= Box::widget([
            'title' => 'Line',
            'tools' => [
                'collapse',
            ],
            'content' => $this->render('_widget-sale-chart'),
        ]) ?>
    </div>
</div>
