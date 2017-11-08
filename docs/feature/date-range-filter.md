# Date Range Filter
对于使用时间戳类存储时间的模型来说，在 GridView 中过滤日期不太方便。

## 通过 DIC 全局配置 DateRangePicker

```php
Yii::$container->set('kartik\daterange\DateRangePicker', [
    'convertFormat'=>true,
    'pluginOptions'=> [
        'locale'=>[
            'format'=>'Ymd',
            'separator' => '-',
            'cancelLabel' => '重置',
        ],
    ],
    'pluginEvents'=> [
        "cancel.daterangepicker" => 'function(ev, picker) {$(this).val("").trigger("change");}',
    ],
]);
```
通过以上配置，使用 DateRangePicker widget 时，只需配置 model 和 atribute 两个属性即可。上面的配置指定日期范围的搜索格式为类似 `20120112-20120201` 的格式。

## Using DateRangePicker Filter in GridView

```php
use kartik\daterange\DateRangePicker;
use yii\grid\GridView;

echo GridView::widget([
    'searchModel' => $serachModel,
    'columns' => [
        [
            'attribute' => 'created_at',
            'format' => 'datetime',
            'contentOptions' => ['style' => 'width:180px'],
            'filter' => DateRangePicker::widget([
                'model' => $searchModel,
                'attribute' => 'created_at',
            ])
        ],
        // other columns configuration
    ],
]);

## Search Model Configuration

First of all, we need to change the rule of `created_at` attribute from `integer` to `safe`.

```php
public function rules()
{
    return [
        [['created_at'], 'safe'],
    ];
}
```

Second, we add a filter query which will convert human-readable string (e.g. 20120112-20120201) to real SQL clause:

```php
// in search model
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
```
