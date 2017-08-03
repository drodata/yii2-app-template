<?php
use yii\bootstrap\ActiveForm;
use backend\models\Lookup;
use kartik\select2\Select2;

$model = new Lookup();
?>

<?php $form = ActiveForm::begin(); ?>

<?php
echo $form->field($model, 'visible')->widget(Select2::classname(), [
    'data' => Lookup::items('UserStatus'),
    'options' => ['placeholder' => '请选择'],
]);
?>
<?php ActiveForm::end(); ?>
