<?php

namespace backend\controllers;

use Yii;

class DemoController extends \yii\web\Controller
{
    public function actionIndex($category)
    {
        return $this->render($category);
    }
    public function actionAjaxGetSelectModal()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $this->renderAjax('_select2-modal');
    }

}
