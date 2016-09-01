<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Html;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "user_group".
 *
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property string $parent_id
 *
 * @property User[] $users
 */
class UserGroup extends \yii\db\ActiveRecord
{
    const STAFF = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_group';
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
            [['name', 'slug'], 'required'],
            [['parent_id'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['slug'], 'string', 'max' => 30],
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '用户分组名称',
            'slug' => '简称',
            'parent_id' => '父分组',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['group_id' => 'id']);
    }

    public static function map()
    {
        return ArrayHelper::map(
            UserGroup::find()->asArray()->all(),
            'id',
            'name'
        );
    }
    /*
    public function append($orderIds)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (!$this->save()) {
                throw new \yii\db\Exception('xxx failed to save.');
            }

            $transaction->commit();
            return true;
        } catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }
    */
}
