<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Lookup;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'test'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'fetch-change-data', 'fetch-print-data'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'fetch-change-data' => ['post'],
                    'fetch-print-data' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'login' => [
                'class' => 'drodata\web\LoginAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * 通用获取由表单元素变化产生的动态数据
     */
    public function actionFetchChangeData()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    
        return Lookup::fetchChangeData(Yii::$app->request->post());
    }

    /**
     * Generic jqprint server action
     *
     * This action is accessed by jQuery's $.post()
     */
    public function actionFetchPrintData()
    {
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return Lookup::fetchPrintData(Yii::$app->request->post());
    }

    /**
     * Test action, used to quick debug
     */
    public function actionTest()
    {
        // put your test code here
    }
}
