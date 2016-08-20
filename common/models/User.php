<?php
namespace common\models;

use Yii;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use backend\models\UserGroup;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $screen_name
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $group_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $last_login_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $owned_by
 * @property string $note
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    private $_userForm;

    const FROZEN = 0;
    const ACTIVE = 1;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

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
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'group_id'], 'required'],
            [['username'], 'unique'],
            ['status', 'default', 'value' => self::ACTIVE],
            //['status', 'in', 'range' => [self::ACTIVE, self::FROZEN]],
            [['group_id', 'screen_name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'screen_name' => '姓名',
            'status' => '状态',
            'group_id' => '用户组',
            'created_at' => '加入日期',
            'updated_at' => '修改日期',
            'last_login_at' => '最近登录日期',
            'created_by' => '创建人',
            'updated_by' => '修改人',
            'owned_by' => '当前负责人',
            'note' => '备注',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(UserGroup::className(), ['id' => 'group_id']);
    }

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

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
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
        ];
        foreach ($roles as $r) {
            $a[] = Html::tag('span', $r->description, [
                'class' => 'label label-' . $colorMap[$r->name],
            ]);
        }
        return implode("&nbsp;", $a);
    }
    public function getReadableName()
    {
        return empty($this->screen_name) 
            ? $this->username 
            : $this->screen_name . ' (' . $this->username . ')';
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
    public static function rolesList()
    {
        $auth = Yii::$app->authManager;
        $a = [];
        foreach ($auth->getRoles() as $name=>$role)
        {
            $a[$name] = $role->description;
        }
        // the `customer` role is belonged to group 'proxy'
        ArrayHelper::remove($a, 'customer');
        return $a;
    }

    public function getUserForm() 
    {
        return $this->_userForm;
    }
    public function setUserForm($value) 
    {
        $this->_userForm = $value;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->password = $this->userForm->password;
                $this->generateAuthKey();
            } else {
            }
            return true;
        } else {
            return false;
        }
    }
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $auth = Yii::$app->authManager;
        if ($insert) {
            // save roles
            $role = $auth->getRole($this->userForm->role);
            $auth->assign($role, $this->id);
        } else {
            // update roles
            $auth->revokeAll($this->id);
            $role = $auth->getRole($this->userForm->role);
            $auth->assign($role, $this->id);
        }
    }
}
