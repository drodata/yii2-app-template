<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use drodata\helpers\Html;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $screen_name
 * @property integer $group_id
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $last_logined_at
 *
 * @property Comment[] $comments
 * @property Comment[] $comments0
 * @property Message[] $messages
 * @property Message[] $messages0
 * @property Notification[] $notifications
 * @property Notification[] $notifications0
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    const FROZEN = 0;
    const ACTIVE = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }


    public function scenarios()
    {
        $default = parent::scenarios();
        $custom = [
            // put custom scenarios here
        ];
        return yii\helpers\ArrayHelper::merge($default, $custom);
    }

    /**
     * key means scenario names
     */
    public function transactions()
    {
        return [
            'default' => self::OP_ALL,
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'group_id', 'email', 'last_logined_at'], 'required'],
            [['group_id', 'status', 'created_at', 'updated_at', 'last_logined_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
        //['passwordOld', 'inlineV'],
    }

    /* inline validator
    public function inlineV($attribute, $params)
    {
        if ($this->$attribute != 'a') {
            $this->addError($attribute, '原密码输入错误');
            return false;
        }
        return true;
    }
    */

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'group_id' => '用户组',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
            'last_logined_at' => '最近登录时间',
        ];
    }
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::ACTIVE]);
    }
    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::ACTIVE,
        ]);
    }
    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    // ==== getter starts ====

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(UserGroup::className(), ['id' => 'group_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['created_by' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments0()
    {
        return $this->hasMany(Comment::className(), ['updated_by' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['updated_by' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages0()
    {
        return $this->hasMany(Message::className(), ['created_by' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(Notification::className(), ['created_by' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications0()
    {
        return $this->hasMany(Notification::className(), ['updated_by' => 'id']);
    }

    /** just role name **/
    public function getRoles()
    {
        $a = [];
        $auth = Yii::$app->authManager;
        $roles = $auth->getRolesByUser($this->id);
        if (sizeof($roles) > 0) {
            foreach ($roles as $role) {
                $a[] = $role->name;
            }
        }
        return $a;
    }

    public function getRolesString()
    {
        $auth = Yii::$app->authManager;
        $roles = $auth->getRolesByUser($this->id);
        if (sizeof($roles) == 0) {
            return '';
        }
        $a = [];
        $colorMap = [
            'admin' => 'danger',
            'dispatcher' => 'success',
            'customerService' => 'info',
            'outsourcing' => 'warning',
            'customer' => 'warning',
            'legacy' => 'primary',
            'offline' => 'default',
            'purchaser' => 'purple',
        ];
        foreach ($roles as $r) {
            $a[] = Html::tag('span', $r->description, [
                'class' => 'label label-' . $colorMap[$r->name],
            ]);
        }
        return implode("&nbsp;", $a);
    }
    /**
     * Judge whether current user in a role (group)
     * @param string | array $role
     * @return boolean
     */
	public function in($role)
	{
		if (gettype($role) == 'string') {
			return in_array($role, $this->roles);
        } else if (gettype($role) == 'array') {
			$flag = false;
			foreach ($this->roles as $roleName)
			{
				$flag = $flag || in_array($roleName, $role);
			}
			return $flag;
		}
	}

    /*
     * for ActiveField
     */
    public static function rolesList()
    {
        $auth = Yii::$app->authManager;
        $a = [];
        foreach ($auth->getRoles() as $name=>$role)
        {
            $a[$name] = $role->description;
        }
        return $a;
    }
}
