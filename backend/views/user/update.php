<?php

use yii\bootstrap\Html;
use drodata\widgets\Box;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Update User: ' . $model->id;
$this->params = [
    'title' => $this->title,
    'breadcrumbs' => [
        ['label' => 'Users', 'url' => ['index']],
        ['label' => $model->id, 'url' => ['view', 'id' => $model->id]],
        'Update',
    ],
];
?>
<div class=row "user-update">
    <div class="col-md-12 col-lg-8 col-lg-offset-2">
        <?php Box::begin([
            'title' => $this->title,
        ]);?>
            <?= $this->render('_form', [
                'user' => $user,
                'userForm' => $userForm,
            ]) ?>
        <?php Box::end();?>
    </div>
</div>
