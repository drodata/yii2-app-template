<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserSearch extends User
{
    public function attributes()
    {
        return parent::attributes();

        // add related fields to searchable attributes
        // return array_merge(parent::attributes(), ['author.name']);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'group_id', 'updated_at', 'logined_at'], 'integer'],
            [['username', 'screen_name', 'auth_key', 'created_at', 'password_hash', 'password_reset_token', 'email', 'note'], 'safe'],
            // usefull when filtering on related columns
            //[['author.name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find()->joinWith(['group']);;
        /*
        $query = User::find()->joinWith(['company']);
            ->where(['{{%company}}.category' => Company::CATEGORY_LOGISTICS]);
        */

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                /*
                'office_phone',
                'group.name' => [
                    'asc'   => ['company.name' => SORT_ASC],
                    'desc'  => ['company.name' => SORT_DESC],
                ],
                'company.name' => [
                    'asc'  => ['CONVERT({{%company}}.full_name USING gbk)' => SORT_ASC],
                    'desc' => ['CONVERT({{%company}}.full_name USING gbk)' => SORT_DESC],
                ],
                */
            ],
            /* Warning: defaultOrder 内指定的列必须在上面的 attributes 内声明过，否则排序无效
            'defaultOrder' => [
                'group.name' => SORT_DESC,
            ],
            */
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'group_id' => $this->group_id,
        ]);
        if (!empty($this->created_at) && strpos($this->created_at, '-') !== false) {
            list($begin, $end) = explode('-', $this->created_at);
            $begin .= ' 00:00:00';
            $end .= ' 23:59:59';
            $query->andFilterWhere([
                'BETWEEN',
                static::tableName() . '.created_at',
                strtotime($begin),
                strtotime($end)
            ]);
        }

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'screen_name', $this->screen_name])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email]);
            //->andFilterWhere(['LIKE', 'user_group.name', $this->getAttribute('group.name')])
        return $dataProvider;
    }
}
