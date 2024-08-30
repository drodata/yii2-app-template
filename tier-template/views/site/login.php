<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\widgets\Panel;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="row" style="margin-top:30px">
		<div class="col-sm-4 col-sm-offset-4 text-center">
			<img src="/img/logo.jpg" />
			<p class="h3 ">网站控制台</p>
		</div>
	<?php Panel::begin([
		'title' => Yii::t('app.crud', 'Login'),
		'width' => 4,
		'float' => 'left',
		'offset' => 4,
	])?>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
	<?php Panel::end()?>
    </div>
</div>
