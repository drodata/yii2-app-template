<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Lookup;
use common\models\User;
use backend\models\UserGroup;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>
	<?php if($user->isNewRecord):?>
        <?= $form->field($user, 'username')->textInput(['maxlength' => true, 'autoFocus' => true]) ?>
        <?= $form->field($userForm, 'password')->passwordInput(['maxlength' => true]) ?>
        <?= $form->field($userForm, 'passwordRepeat')->passwordInput(['maxlength' => true]) ?>
	<?php endif;?>

    <?= $form->field($user, 'screen_name')->textInput(['maxlength' => true, 'placeholder' => '选填']) ?>
    <?= $form->field($user, 'group_id')->radioList(UserGroup::map()) ?>

	<?php 
    if(Yii::$app->user->can('admin')) {
        echo $form->field($userForm, 'role')->radioList(User::rolesList());
    } ?>

    <div class="form-group">
        <?= Html::submitButton($user->isNewRecord ? '新建' : '保存', ['class' => $user->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
