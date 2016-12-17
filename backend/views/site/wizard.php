<?php

/**
 * Use in controller:
 * return $this->render(
    '/site/wizard',
    'title' => '',
    'style' => '',
    'content' => '',
    'buttons' => [],
   );
 */
use drodata\helpers\Html;
use drodata\widgets\Box;

/* @var $this yii\web\View */
/* @var array $wizard */

$this->title = $title;
?>
<div class="row site-wizard">
    <div class="col-md-12 col-lg-6 col-lg-offset-3 text-center">
        <?php Box::begin([
            'title' => $title, 
            'style' => $style,
        ]);?>
            <?= $content ?>
            <div class="button-group">
                <?= implode('', $buttons) ?>
            </div>
        <?php Box::end();?>
    </div>
</div>
