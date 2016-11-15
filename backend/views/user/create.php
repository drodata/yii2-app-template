<?php

use yii\bootstrap\Html;
use common\widgets\Box;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Create User';
$this->params = [
    'title' => $this->title,
    'breadcrumbs' => [
        ['label' => 'Users', 'url' => ['index']],
        $this->title,
    ],
];
?>
<div class="row user-create">
    <div class="col-md-12 col-lg-6 col-lg-offset-3">
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
