<?php
use yii\bootstrap\ActiveForm;
use backend\models\Lookup;
use kartik\widgets\Select2;

$model = new Lookup();
?>

<?= Select2::widget([
    'data' => $lists,
    'options' => ['placeholder' => '请选择'],
    'addon' => [
        'append' => [
            'content' => Html::button(Html::icon('plus'), [
                'class' => 'btn btn-default modal-create-customer', 
                'title' => '新建', 
            ]),
            'asButton' => true
        ]
    ],
])?>
