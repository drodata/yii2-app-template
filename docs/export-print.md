# 页面内直接打印

借助 jQuery jqprint 插件，可以打印 DOM 中局部内容。页面内直接打印的思路很简单：借助 AJAX 把需要打印的内容发送到 DOM 内，使用 `.jqprint()` 触发。此插件已集成在 `drodata\jqprint\PrintAsset` 内。

在实际应用中，都是打印具体 AR 模型内容，例如订单、发货单、退货单等等，为了避免在每一个具体模型的控制器内重复声明 actions, 我们仿照 `site/fetch-change-data` action 做了一个通用的打印 action. 假设我们有一个 Order 订单模型，需要打印订单，代码主要包括一下几处：

## 通用的动作 `site/fetch-print-data`

```php
// in backend\controllers\SiteController
public function actionFetchPrintData()
{
    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    return Lookup::fetchPrintData(Yii::$app->request->post());
}
```

## 通用的事件绑定机制

```js
// in backend\web\js/ajax-operation.js
$(document).on('click', '.direct-print', function(e) {
	e.preventDefault();
    $(this).tooltip('hide');
    var postData = $(this).data('post')
	$.post(APP.baseUrl + 'site/fetch-print-data', postData, function(response) {
		$(".generic-print-wrapper").empty().html( response ).jqprint();
	}); 
}); 
```

## 实际生成打印页面内容的方法 `Lookup::fetchPrintData()`

```php
// in backend\models\Lookup.php
public static function fetchPrintData($configs)
{
    $key = ArrayHelper::remove($configs, 'key');
    $section = ArrayHelper::remove($configs, 'section');
    $view = $section ? "/{$key}/_print-{$section}" : "/{$key}/_print";
    $id = ArrayHelper::remove($configs, 'id');

    switch ($key) {
        case 'order':
            $header = '订单';
            $model = Order::findOne($id);
            break;
    }

    return Yii::$app->view->render('/site/_print', [
        'header' => $header,
        'content' => Yii::$app->view->render($view, ['model' => $model]),
    ]);
}
```

## 打印视图

我们把打印页面中通用的表头部分单独放在 `site/_print` 视图内，实际模型的 `_print` 只存放最核心的内容。

```php
<?php
/* @var string $header */
/* @var string $content */
?>

<div class="row">
    <div class="col-xs-12">
        <div style="margin-bottom:20px;">
            <h3 class="text-center">公司名称</h3>
            <h4 class="text-center"><?= $header ?></h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <?= $content ?>
    </div>
</div>
```

具体的订单打印视图 `_print.php` 大致如下：

```php
<?php
/* @var Order $model */
?>
<table class="table table-condensed" style="table-layout:fixed">
    <tbody>
        <tr>
            <th width="25%"><?= $model->getAttributeLabel('seller_id') ?></th>
            <td width="25%"><?= $model->seller->name ?></td>
            <th width="25%">数量</th>
            <td width="25%"><?= $model->getQuantity(true) ?></td>
        </tr>
        <tr>
            <th colspan="1">明细</th>
            <td colspan="3"><?= $this->render('_grid-item', ['model' => $model]) ?></td>
        </tr>
</table>
```

## 具体的触发按钮

```php
echo Html::a('打印订单', 'javascript:void(0)', [
    'class' => 'btn btn-primary direct-print',
    'data' => [
        'post' => [
            'key' => 'order',
            'section' => 'shipping-list',
            'id' => 123,
        ],
    ],
]);
```
`direct-print` 类名触发事件。携带的数据中，`key` 代表模型名称，如果一个模型内需要打印多个内容，例如一个订单既需要打印发货清单又需要打印订单，此时可以使用 `section` 选项进一步标记。
