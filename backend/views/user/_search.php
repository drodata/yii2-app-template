<?php

use yii\bootstrap\ActiveForm;
use drodata\helpers\Html;
use drodata\widgets\Box;
use commom\models\Lookup;

/* @var $this yii\web\View */
/* @var $model backend\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row user-search">
    <div class="col-sm-12">
        <?php Box::begin([ 'title' => '搜索', 'style' => 'info']);?>
            <?php $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
            ]); ?>
            <?= $form->field($model, 'id') ?>

            <?= $form->field($model, 'username') ?>

            <?= $form->field($model, 'screen_name') ?>

            <?= $form->field($model, 'group_id') ?>

            <?= $form->field($model, 'auth_key') ?>

            <?php // echo $form->field($model, 'password_hash') ?>

            <?php // echo $form->field($model, 'password_reset_token') ?>

            <?php // echo $form->field($model, 'email') ?>

            <?php // echo $form->field($model, 'status') ?>

            <?php // echo $form->field($model, 'created_by') ?>

            <?php // echo $form->field($model, 'updated_by') ?>

            <?php // echo $form->field($model, 'created_at') ?>

            <?php // echo $form->field($model, 'updated_at') ?>

            <?php // echo $form->field($model, 'last_logined_at') ?>

            <div class="form-group">
                <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('重置', "/user/index", ['class' => 'btn btn-default']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        <?php Box::end();?>
    </div>
</div>
