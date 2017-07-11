<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\base\InvalidParamException;
use yii\behaviors\BlameableBehavior;
use drodata\helpers\Html;
use drodata\behaviors\TimestampBehavior;

/**
 * This is the model class for table "warehousing".
 *
 * @property string $id
 * @property integer $sender
 * @property integer $device
 * @property string $number
 * @property integer $quantity
 * @property integer $status
 * @property string $mv
 * @property string $d10
 * @property string $d50
 * @property string $d90
 * @property string $d95
 * @property string $channel_max
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $created_by
 * @property string $updated_by
 */
class Warehousing extends \yii\db\ActiveRecord
{
    //const EVENT_ = '';

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
        return 'warehousing';
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
            [['sender', 'device', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'required'],
            [['sender', 'device', 'quantity', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['mv', 'd10', 'd50', 'd90', 'd95', 'channel_max'], 'number'],
            [['number'], 'string', 'max' => 16],
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
        return [
            'id' => 'ID',
            'sender' => 'Sender',
            'device' => 'Device',
            'number' => 'Number',
            'quantity' => 'Quantity',
            'status' => 'Status',
            'mv' => 'Mv',
            'd10' => 'D10',
            'd50' => 'D50',
            'd90' => 'D90',
            'd95' => 'D95',
            'channel_max' => 'Channel Max',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Render a specified action link, which is usually used in 
     * GridView or ListView.
     *
     * @param string $action action name
     * @param string $type link type, 'icon' and 'button' are available,
     * the former is used in action column in grid view, while the latter
     * is use in list view.
     * @return mixed the link html content
     */
    public function actionLink($action, $type = 'icon')
    {
        $route = '/warehousing/' . $action;
        switch ($action) {
            case 'view':
                return Html::actionLink(
                    [$route, 'id' => $this->id],
                    [
                        'type' => $type,
                        'title' => '详情',
                        'icon' => 'eye',
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
