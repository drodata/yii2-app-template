<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use drodata\helpers\Html;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "user_group".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property integer $parent_id
 */
class UserGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_group';
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
            [['name', 'slug', 'parent_id'], 'required'],
            [['parent_id'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 50],
            [['name'], 'unique'],
            [['slug'], 'unique'],
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
            'name' => 'Name',
            'slug' => 'Slug',
            'parent_id' => 'Parent ID',
        ];
    }

    // ==== getter starts ====


    // ==== getter ends ====

    /**
     * @inheritdoc
     * @return boolean
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                // you logic
            } else {
            }
            return true;
        } else {
            return false;
        }
    }
    /**
     * @inheritdoc
     * @return void
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($insert) {
            // logic
        } else {
            // logic
        }
    }
    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            // ...custom code here...
            return true;
        } else {
            return false;
        }
    }
    /**
     * @inheritdoc
     * @return void
     */
    public function afterDelete()
    {
        parent::afterDelete();
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
