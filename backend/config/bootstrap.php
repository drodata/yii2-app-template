<?php
Yii::$container->set('yii\grid\GridView', [
    'options' => ['class' => 'table-responsive grid-view'],
    'tableOptions' => [
        'class' => 'table table-striped table-hover',
    ],
]);
