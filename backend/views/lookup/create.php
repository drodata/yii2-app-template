<?php

use yii\bootstrap\Html;
use common\widgets\Box;

/* @var $this yii\web\View */
/* @var $model common\models\Lookup */

$this->title = 'Create Lookup';
$this->params = [
    'title' => $this->title,
    'breadcrumbs' => [
        ['label' => 'Lookups', 'url' => ['index']],
        $this->title,
    ],
];
?>
<div class="row lookup-create">
    <div class="col-md-12 col-lg-8 col-lg-offset-2">
        <?php Box::begin([
            'title' => $this->title,
        ]);?>
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        <?php Box::end();?>
    </div>
</div>
