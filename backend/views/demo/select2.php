<?php
use drodata\helpers\Html;
use drodata\widgets\Box;
use yii\widgets\ActiveForm;
use common\models\Lookup;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */

$this->title = 'Select2';
$this->params = [
    'title' => $this->title,
    'breadcrumbs' => [
        ['label' => 'Index', 'url' => 'index'],
        $this->title,
    ],
];

$model = new Lookup();
$lists = ArrayHelper::map(Lookup::find()->asArray()->all(), 'id', 'name');
?>
<div class="col-lg-6 col-lg-offset-3 col-md-12">
<?php
Box::begin([
    'title' => $this->title,
    'tools' => [
    ],
]);
?>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'id')->dropDownList($lists) ?>

    <?php
    echo $form->field($model, 'name')->widget(Select2::classname(), [
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
    ]);
    ?>

    <div class="form-group">
        <?= Html::button('在 Modal 内使用 Select2', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

<?php Box::end();?></div>
