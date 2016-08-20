<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Html;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use common\models\Lookup;
//use common\models\User;

/**
 * This is the model class for table "lookup".
 *
 * @property string $id
 * @property string $name
 * @property integer $code
 * @property string $type
 * @property integer $position
 */
class Lookup extends \yii\db\ActiveRecord
{
    private static $_items=array();
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lookup';
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
            [['name', 'code', 'type', 'position'], 'required'],
            [['code', 'position'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['type'], 'string', 'max' => 128],
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
            'code' => 'Code',
            'type' => 'Type',
            'position' => 'Position',
        ];
    }

    public static function items($type, $key='code')
    {
        return ArrayHelper::map(
            self::find()->where([
                'type' => $type,
            ])->orderBy('position')->asArray()->all(),
            $key,
            'name'
        );
    }

    public static function item($type,$code)
    {
        return self::findOne([
            'type' => $type,
            'code' => $code,
        ])->name;
    }
}
