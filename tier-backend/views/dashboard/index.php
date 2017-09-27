<?php
use drodata\widgets\Box;
/* @var $this yii\web\View */

$this->title = 'Dashboard';
$this->params = [
    'title' => $this->title,
    'breadcrumbs' => [
        ['label' => 'Index', 'url' => 'index'],
        $this->title,
    ],
];
?>
<div class="row">
    <div class="col-md-8 col-sm-12">
        <?= Box::widget([
            'title' => 'Sale Report',
            'tools' => [
                'collapse',
            ],
            'content' => 'a',//$this->render('/demo/_widget-sale-chart'),
        ]) ?>
    </div>
</div>
