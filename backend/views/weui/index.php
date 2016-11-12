<?php
use common\weui\Html;
use common\weui\Message;

/* @var $this yii\web\View */

$this->title = 'Dashboard';

$css = <<<CSS
.icon-lg { font-size: 93px;}
.text-success {color: #09BB07 !important;}
.text-info {color: #10AEFF !important;}
.text-danger {color: #F43530 !important;}
.text-muted {color: #B2B2B2 !important;}
CSS;
$this->registerCss($css);

$js = <<<JS
$('.gogo').click(function() {
    $.weui.alert('good.');
});
JS;
$this->registerJs($js);

$a = Html::button('ago', [
    'class' => 'btn btn-default gogo',
]);

echo $a;

?>
