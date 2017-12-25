<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\base\InvalidParamException;
use drodata\helpers\Html;

/**
 * This is the model class for table "lookup".
 *
 * @property integer $id
 * @property string $name
 * @property integer $code
 * @property string $type
 * @property integer $position
 * @property integer $visible
 */
class Lookup extends \yii\db\ActiveRecord
{
    //const EVENT_ = '';
    private static $_items = [];

    public function init()
    {
        parent::init();
        //$this->on(self::EVENT_AFTER_SAVE, [$this, 'handlerName']);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lookup';
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
            /*
            [
                'class' => TimestampBehavior::className(),
                'updatedAtAttribute' => false,
            ],
            [
                'class' => BlameableBehavior::className(),
                'updatedByAttribute' => false,
            ],
            */
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code', 'type', 'position'], 'required'],
            [['code', 'position', 'visible'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['type'], 'string', 'max' => 128],
            [['name'], 'unique', 'targetAttribute' => ['name', 'type'], 'message' => '{value}已存在'],
        ];
        //['passwordOld', 'inlineV'],
    }

    /* inline validator
    public function inlineV($attribute, $params, $validator)
    {
        if ($this->$attribute != 'a') {
            $this->addError($attribute, 'error message');
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
        switch ($this->type) {
            case 'DemoProduct':
                $name = '临时商品名称';
                break;
            default:
                $name = '名称';
                break;
        }
        return [
            'id' => 'ID',
            'name' => $name,
            'code' => 'Code',
            'type' => 'Type',
            'position' => 'Position',
            'visible' => 'Visible',
        ];
    }

    public static function items($type, $key='code')
    {
        return ArrayHelper::map(
            self::find()->where([
                'type' => $type,
                'visible' => 1,
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
            'visible' => 1,
        ])->name;
    }

    /**
     * Get the next code of a specified type.
     * @return int
     */
	public static function nextCode($type)
	{
		return self::find()->where(['type' => $type, 'visible' => 1])->max('code') + 1;
	}

    public function actionLink($action, $type = 'icon')
    {
        $route = '/lookup/' . $action;
        switch ($action) {
            case 'quick-update':
                return Html::actionLink(
                    [$route, 'id' => $this->id],
                    [
                        'type' => $type,
                        'title' => '修改',
                        'icon' => 'pencil',
                    ]
                );
                break;
            case 'view':
                return Html::actionLink(
                    [$route, 'id' => $this->id],
                    [
                        'type' => $type,
                        'title' => '详情',
                        'icon' => 'eye',
                        'class' => 'modal-view',
                    ]
                );
                break;
            case 'update':
                return Html::actionLink(
                    [$route, 'id' => $this->id],
                    [
                        'type' => $type,
                        'title' => '修改',
                        'icon' => 'pencil',
                    ]
                );
                break;
            case 'delete':
                return Html::actionLink(
                    [$route, 'id' => $this->id],
                    [
                        'type' => $type,
                        'title' => '删除',
                        'icon' => 'trash',
                        'color' => 'danger',
                        'data' => [
                            'method' => 'post',
                            'confirm' => '请再次确认删除操作。',
                        ],
                    ]
                );
                break;
        }
    }

    // ==== getters start ====


    // ==== getters end ====

    /**
     * Transaction block template
     *
    public function create($data)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (!$this->save()) {
                throw new \yii\db\Exception('Failed to insert xxx.');
            }

            $transaction->commit();
            return true;
        } catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }
    */

    // ==== event-handlers begin ====
    // ==== event-handlers end ====
}
