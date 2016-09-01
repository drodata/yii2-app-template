<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\UserSearch;
use backend\models\UserForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
                        //'actions' => ['create', 'view', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays current user model.
     * @param string $id
     * @return mixed
     */
    public function actionProfile()
    {
        return $this->render('profile', [
            'model' => $this->findModel(Yii::$app->user->id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $user = new User;
        $userForm = new UserForm(['scenario' => UserForm::SCENARIO_CREATE]);

        if ($user->load(Yii::$app->request->post()) && $userForm->load(Yii::$app->request->post())) {
			if ($user->validate() && $userForm->validate()) {

                $user->userForm = $userForm;
                if ($user->save()) {
                    Yii::$app->session->setFlash('success', '用户已创建');
				    return $this->redirect('index');
                }
			}
		}
        return $this->render('create', [
            'user' => $user,
            'userForm' => $userForm,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $user = $this->findModel($id);
        $userForm = UserForm::loadModel($user);

        if ($user->load(Yii::$app->request->post()) && $userForm->load(Yii::$app->request->post())) {
			if ($user->validate() && $userForm->validate()) {

                $user->userForm = $userForm;
                if ($user->save()) {
                    Yii::$app->session->setFlash('success', '用户信息已保存');
				    return $this->redirect('index');
                }
			}
		}
        return $this->render('update', [
            'user' => $user,
            'userForm' => $userForm,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
