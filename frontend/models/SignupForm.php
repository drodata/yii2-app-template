<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use backend\models\Team;
use backend\models\Department;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $teamname;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            [['teamname'], 'required'],
            [['teamname'], 'string', 'max' => 45],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $transaction = Team::getDb()->beginTransaction();

        try {
            $team = new Team();
            $team->name = $this->teamname;
            $team->level = Team::LEVEL_BASIC;
            $team->save();
        
            $department = new Department();
            $department->name = '信息部';
            $department->slug = 'admin';
            $department->parent_id = 0;
            $department->team_id = $team->id;
            $department->save();
        
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->department_id = $department->id;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->save();

            $transaction->commit();
            return $user;
        } catch (yii\db\Exception $e) {
            $transaction->rollBack();
            throw $e;

            return null;
        }
    }
}
