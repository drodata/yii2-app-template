<?php

use drodata\helpers\Html;
use drodata\widgets\Box;

/* @var $this yii\web\View */
/* @var $model backend\models\Lookup */

$this->title = '修改Lookup: ' . $model->id;
$this->params = [
    'title' => '修改',
    'subtitle' => '',
    'breadcrumbs' => [
        ['label' => 'Lookups', 'url' => ['index']],
        ['label' => $model->name, 'url' => ['view', 'id' => $model->id]],
    ],
];
?>
<div class=row "lookup-update">
    <div class="col-md-12 col-lg-6 col-lg-offset-3">
        <?= Box::widget([
            'title' => $this->title,
            'content' => $this->render('_form', [
                'model' => $model,
            ]),
        ]) ?>
    </div>
</div>
