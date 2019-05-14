<?php
/* @var $header string */
/* @var $content string */
?>

<div class="row">
    <div class="col-xs-12">
        <div style="margin-bottom:20px;">
            <h3 class="text-center"><?= Yii::$app->name ?></h3>
            <h4 class="text-center"><?= $header ?></h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <?= $content ?>
    </div>
</div>
