<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $createUser = $auth->createPermission('createUser');
        $createUser->description = 'Create an user';
        $auth->add($createUser);

        // add "admin" role and give this role the "createPost" permission
        $admin = $auth->createRole('admin');
        $admin->description = '系统管理员';
        $auth->add($admin);
        $auth->addChild($admin, $createUser);

        // Assignment
        $auth->assign($admin, 1);
    }

    public function actionFlush()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }
}
