<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="skin-blue layout-top-nav">
<?php $this->beginBody() ?>

<div class="wrap">
    <?= $this->render('_header') ?>
    <div class="content-wrapper">
        <div class="container">
            <section class="content-header">
                <h1> <?= $this->params['title'] ?><small></small> </h1>
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </section>
            <section class="content">
                <?= Alert::widget() ?>
                <?= $content ?>
            </section>
        </div>
    </div>
</div>
<footer class="main-footer">
    <div class="container">
        <div class="pull-right hidden-xs">
            <?= Yii::powered() ?>
        </div>
        <strong>&copy; My Company <?= date('Y') ?></strong> All rights reserved.
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
