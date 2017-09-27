<?php
namespace backend\models;

use Yii;
use yii\base\Model;

/**
 */
class UserForm extends Model
{
    public $password;
    public $passwordRepeat;
    public $role;
    public $resetpswd;

    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_RESET_PSWD = 'reset-pswd';
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role', 'password'], 'required'],
            [['password'], 'string', 'min' => 6],
            [['passwordRepeat'], 'compare', 'compareAttribute' => 'password', 'on' => self::SCENARIO_CREATE],
            /*
            [['role'], 'required'],
            [['password'], 'required', 'on' => self::SCENARIO_CREATE],
            [['password'], 'string', 'min' => 6, 'on' => self::SCENARIO_CREATE],
            [['passwordRepeat'], 'compare', 'compareAttribute' => 'password','on' => self::SCENARIO_CREATE],
            [
                'credit',
                'required',
                'on' => self::SCENARIO_CREATE,
                'when' => function($model) {
                    return $model->role == 'outsourcing';
                },
                'whenClient' => "function (attribute, value) {
                    return $('#userform-role').find('input:checked').val() == 'outsourcing';
                }"
            ],
            ['credit', 'number', 'min' => 1, 'on' => self::SCENARIO_CREATE],

            [
                'credit',
                'required',
                'on' => self::SCENARIO_UPDATE,
                'when' => function($model) {
                    return $model->role == 'outsourcing';
                },
                'whenClient' => "function (attribute, value) {
                    return $('#userform-role').find('input:checked').val() == 'outsourcing';
                }"
            ],
            ['credit', 'number', 'min' => 1, 'on' => self::SCENARIO_UPDATE],

            [['resetpswd'], 'required', 'on' => self::SCENARIO_RESET_PSWD],
            [['resetpswd'], 'string', 'min' => 6, 'on' => self::SCENARIO_RESET_PSWD],
            */
        ];
    }

    public function changepswd()
    {
        if ($this->validate()) {
            $user = Yii::$app->user->identity;
            $user->password_hash = Yii::$app->security->generatePasswordHash($this->passwordNew);
            return $user->update();
        } else {
            return false;
        }
    }
    public function resetpswd($user)
    {
        if ($this->validate()) {
            $user->password_hash = Yii::$app->security->generatePasswordHash($this->resetpswd);
            return $user->update();
        } else {
            return false;
        }
    }
    public static function loadModel($user)
    {
        $userForm = new UserForm(['scenario' => UserForm::SCENARIO_UPDATE]);
        $auth = Yii::$app->authManager;
        foreach ($auth->getRolesByUser($user->id) as $name => $obj) {
            $userForm->role = $name;
        }
        return $userForm;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'password' => '密码',
            'passwordRepeat' => '重复密码',
            'role' => '角色',
            'resetpswd' => '初始密码',
            'credit' => '外包客服信用额度',
        ];
    }
}

