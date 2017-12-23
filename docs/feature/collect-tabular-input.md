# 在一个页面内实现动态增加、删除 tabular input

假设有一个新建订单页面，一个订单包括多个商品。这里的“多个商品”就属于 tabular input, 而且是动态改变的——用户可以新增、删除商品，最后提交订单，一个订单涉及的所有模型数据会被一次性写入。商品的个数是动态改变这一特性，决定了这里的操作需要通过 AJAX 完成。[Yii2 Guide 对应章节的文档还是空白][related-section]，这里简述一下过程。

## 一、商品行内容的生成方式

我们可以完全使用 JS 来拼装出对应的表单元素，但这种办法不能最大程度上发挥 Yii2 Active Form 的相关 API, 且手动拼装极易出错。这里介绍一种类似模板的思路：在订单视图目录下新建一个专门存储商品行的 HTML 代码模板：

```php
<?php

use yii\bootstrap\ActiveForm;
use drodata\helpers\Html;
use backend\models\Lookup;
use backend\models\Goods;

$key = 'drodata';
$goods = new Goods();
$js = <<<JS
// remove useless form element
$('form#xxx').remove();
JS;
$this->registerJs($js);
?>
<?php $form = ActiveForm::begin(['id' => 'xxx']); ?>
<?php $form = ActiveForm::end(); ?>

<div class="hide">
<div class="tabular-row">
    <table><tbody>
        <tr class="itemRow" data-key="<?= $key ?>">
            <td>
                <?= $form->field($goods, "[$key]product_id")->label(false)->dropDownList(Lookup::productMap(), [
                    'prompt' => '请选择产品',
                ]) ?>
            </td>
            <td>
                <?= $form->field($goods, "[$key]quantity")->label(false)->input('number', []) ?>
            </td>
            <td class="text-right">
                <?= Html::button('删除', ['class' => 'btn btn-sm btn-danger delete-row']) ?>
            </td>
        </tr>
    </tbody></table>
</div>
</div>
```

新建页面加载完毕后，商品隐藏在 DOM 中。`$key` 是一个 token, 当用户点击“继续添加”时，在显示之前，会将 token 替换成一个数字 id.

```js
function add_row(i) {
    var tpl = $('.tabular-row tbody').html();
    tpl = tpl.replace(/drodata/g, i);
    $(tpl).appendTo(container);
}
```

表单提交采用 AJAX 实现：

```js
var af = $('#order-form');
var submitBtn = af.find('button[type=submit]');

// 在其它地方使用，仅需更改 $.post() 中的 url
af.submit(function(e){
    e.preventDefault();
    e.stopImmediatePropagation();

    $.post(APP.baseUrl + 'order/ajax-submit', af.serialize(), function(response) {
        // 含有非法数据，显示错误提示
        if (!response.status) {
            af.displayErrors(response)
            return false;
        }

        // 提交成功
        $(response.message).insertAfter(submitBtn);

		setInterval(function(){
			window.location.href = response.redirectUrl;
		},1000);
    }).fail(ajax_fail_handler).always(function(){
    });
});
```

## 二 服务器端验证模型数据

`ajax-submit` controller action 本身很简单，我们将主要的逻辑代码（模型的验证和保存）放在模型的 `ajaxSubmit()` 内

```php
public function actionAjaxSubmit()
{
    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    return Order::ajaxSubmit($_POST);
}
```

```php
// in Order.php
public static function ajaxSubmit($requestData)
{
    $d['status'] = true;

    $model = new Order();
    $model->load($requestData);
    $d['status'] = $model->validate() && $d['status'];
    if (!$model->validate()) {
        $d['errors']['order'] = $model->getErrors();
    }

    // goods items
    $items = [];
    foreach ($requestData['Item'] as $index=>$item) {
        $items[$index] = new Item();
    }
    Item::loadMultiple($items, $requestData);
    foreach ($requestData['Item'] as $index=>$item) {
        $d['status'] = $items[$index]->validate() && $d['status'];
        if (!$items[$index]->validate()) {
            // 这里的 $key 的值是对应表单元素的 'id' 值
            $key = "item-$index";
            $d['errors'][$key] = $items[$index]->getErrors();
        }
    }

    // 所有数据均合法，开始数据写入
    if ($d['status']) {
        if (!$model->save()) {
            throw new \yii\db\Exception('Failed to insert order.');
        }
        
        $d['message'] = Html::tag('span', Html::icon('check') . '已保存', [
            'class' => 'text-success',
        ]);
        $d['redirectUrl'] = Url::to(['/purchase/index']);
    }

    return $d;
}
```

`ajaxSubmit()` 返回值是关系数组，`status` 键表示是否数据是否合法。合法时，`message` 和 `redirectUrl` 两个键分别包含操作成功时的提示信息和跳转地址，非法时，`errors` 键存储非法数据的提示信息。

```php
// failure
[
    'status' => false,
    'errors' => [
        'order' => ['客户名称不能为空'],
        'item-1-price' => ['单价不能为空'],
        'item-2-quantity' => ['数量不能为空'],
    ],
]

// 成功返回值举例
[
    'status' => true,
    'message' => '订单已创建',
    'redirectUrl' => Url::to(['/purchase/index']),
]
```

## 三 客户端处理返回结果

回头再看一下前面的 AJAX 提交代码：

```js
$.post(APP.baseUrl + 'order/ajax-submit', af.serialize(), function(response) {
    if (!response.status) {
        // displayErrors 是一个自定义 jQuery 函数,内容在下面
        af.displayErrors(response)
        return false;
    }

    // 提交成功
    $(response.message).insertAfter(submitBtn);

	setInterval(function(){
		window.location.href = response.redirectUrl;
	},1000);
}).fail(ajax_fail_handler).always(function(){
});
```
定义一个 jQuery 函数，专门显示错误信息：

```js
(function ( $ ) {
    $.fn.displayErrors = function (response) {
        // 清空之前的错误信息
        this.find('.has-error').each(function(){
            $(this).removeClass('has-error');
        })
        this.find('.help-block').each(function(){
            $(this).empty();
        })
        
        // 显示错误信息
        for (var model in response.errors) {
            for (var attribute in response.errors[model]) {
                var ae = $('#' + model + '-' + attribute);
                var formGroup = ae.parents('.form-group').first();
                formGroup.addClass('has-error');
                formGroup.find('.help-block').empty().text(response.errors[model][attribute][0]);
            }
        }
    }

} ( jQuery ));
```
至此，新建操作的整个流程完成。

## 四、特殊规则的验证

上面的数据验证有一定局限性，举一个实际中遇到的例子：一个订单允许提交商品的总数有要求，不允许超过某个值。这个规则就无法直接实现。它的验证规则是基于多个模型而不是单个模型。这类规则的错误信息跟任何属性无关，因此应该单独在地个位置显示，暂时选定在提交按钮的下面。

### 4.1 服务器端的验证

```php
$errors = [];
$amt = 0;
foreach ($items as $item) {
    $amt += $item->quantity;
}
if ($amt > 10) {
    $errors[] = '商品总数不允许大于10';
}
if (!empty($errors)) {
    $d['status'] = false && $d['status'];
    // 这里选用一个特殊的键值 _hybrid 存储这类错误
    $d['errors']['_hybrid'] = $errors[0];
}
```

### 4.2 客户端验证

我们对上面的 `displayErrors()` 稍加改进：

```js
//displayErrors 函数片段

for (var model in response.errors) {
    // 遍历时如果有混合错误信息，显示在提交按钮下方
    if (model == '_hybrid') {
        var submitBtn = this.find('button[type=submit]');
        var msg = response.errors[model]
        $('<span class="help-block">' + msg + '</span>').insertAfter(submitBtn)
        var formGroup = submitBtn.parents('.form-group').first();
        formGroup.addClass('has-error');
    }
    for (var attribute in response.errors[model]) {
        // ...
    }
}
```

[related-section]: http://www.yiiframework.com/doc-2.0/guide-input-tabular-input.html#combining-update-create-and-delete-on-one-page
