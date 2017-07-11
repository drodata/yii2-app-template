<?php

use drodata\helpers\Html;
use drodata\widgets\Box;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = '修改User: ' . $model->id;
$this->params = [
    'title' => '修改',
    'subtitle' => '',
    'breadcrumbs' => [
        ['label' => 'Users', 'url' => ['index']],
        ['label' => $model->id, 'url' => ['view', 'id' => $model->id]],
    ],
];
?>
<div class=row "user-update">
    <div class="col-md-12 col-lg-6 col-lg-offset-3">
        <?= Box::widget([
            'title' => $this->title,
            'content' => $this->render('_form', [
                'model' => $model,
            ]),
        ]) ?>
    </div>
</div>
