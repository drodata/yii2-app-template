<?php

use yii\helpers\Html;
use yii\bootstrap\BaseHtml;
use yii\bootstrap\ActiveForm;
use common\widgets\Box;
use commom\models\Lookup;

/* @var $this yii\web\View */
/* @var $model backend\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row user-search">
    <div class="col-sm-12">
        <?php Box::begin([ 'title' => '搜索', ]);?>
            <?php $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
            ]); ?>
            <?= $form->field($model, 'id') ?>

            <?= $form->field($model, 'username') ?>

            <?= $form->field($model, 'screen_name') ?>

            <?= $form->field($model, 'auth_key') ?>

            <?= $form->field($model, 'password_hash') ?>

            <?php // echo $form->field($model, 'password_reset_token') ?>

            <?php // echo $form->field($model, 'email') ?>

            <?php // echo $form->field($model, 'status') ?>

            <?php // echo $form->field($model, 'group_id') ?>

            <?php // echo $form->field($model, 'created_at') ?>

            <?php // echo $form->field($model, 'updated_at') ?>

            <?php // echo $form->field($model, 'last_login_at') ?>

            <?php // echo $form->field($model, 'created_by') ?>

            <?php // echo $form->field($model, 'updated_by') ?>

            <?php // echo $form->field($model, 'owned_by') ?>

            <?php // echo $form->field($model, 'note') ?>

            <div class="form-group">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
