<?php
use common\weui\Html;

/* @var $this yii\web\View */

$this->title = 'Dashboard';

$a = Html::button('a', [
    'class' => 'btn btn-danger gogo',
]);

$b = ['a', 'b'];
unset($b[0]);
var_dump($a);
?>
