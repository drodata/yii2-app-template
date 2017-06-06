<?php

/**  Least **/

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?= Html::csrfMetaTags() ?>
    <title>Template 101</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
	<div class="container">
		<?= $content ?>
	</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

