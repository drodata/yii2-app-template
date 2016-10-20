<?php

namespace backend\controllers;

class DemoController extends \yii\web\Controller
{
    public function actionIndex($category)
    {
        return $this->render($category);
    }

}
