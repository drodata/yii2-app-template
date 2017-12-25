<?php

/**
 */

/* @var $this yii\web\View */
/* @var $model backend\models\Map */

use yii\bootstrap\ActiveForm;
use drodata\helpers\Html;
use drodata\widgets\Box;
use kartik\select2\Select2;
use backend\models\Lookup;

$this->title = '新建临时商品';
$this->params = [
    'title' => $this->title,
    'breadcrumbs' => [
        ['label' => '临时商品', 'url' => 'manage-product'],
        $this->title,
    ],
];

?>
<div class="row acceptance-form">
    <div class="col-md-12 col-lg-4 col-lg-offset-4">
        <?php Box::begin([
        ]); ?>
            <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'from_id')->label('临时商品')->widget(Select2::classname(), [
                    'data' => Lookup::items('DemoProduct'),
                    'options' => ['placeholder' => '请选择'],
                    'addon' => [
                        'append' => [
                            'content' => Html::button(Html::icon('plus'), [
                                'class' => 'btn btn-primary ajax-quick-create-lookup', 
                                'title' => '新增临时商品', 
                                'data' => [
                                    'type' => 'DemoProduct',
                                ],
                            ]),
                            'asButton' => true
                        ]
                    ],
                ]) ?>
            <?php ActiveForm::end(); ?>
        <?php Box::end(); ?>
    </div>
</div>
