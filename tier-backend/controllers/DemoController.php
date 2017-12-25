<?php

namespace backend\controllers;

use Yii;
use backend\models\Map;
use backend\models\LookupSearch;

class DemoController extends \yii\web\Controller
{
    public function actionIndex($category)
    {
        return $this->render($category);
    }
    /**
     * 管理临时产品
     */
    public function actionManageProduct()
    {
        $searchModel = new LookupSearch(['type' => 'DemoProduct']);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('manage-product', [
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * 管理临时产品
     */
    public function actionModalCreateProduct()
    {
        // 使用 Map 无任何实际意义，仅仅为了演示作用
        $model = new Map();
        return $this->render('modal-create-product', [
            'model' => $model,
        ]);
    }
    public function actionAjaxGetSelectModal()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $this->renderAjax('_select2-modal');
    }

}
