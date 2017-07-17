# Select2

http://demos.krajee.com/widget-details/select2

## 初阶

- array `data`: 适合使用 'yii\helpers\ArrayHelper::map()' 生成；
- string `theme`: 默认值：'krajee', 其它可选值：'default' (和 AdminLTE 更搭配一些), 'bootstrap' 和 'classic'
- array `options`: 
    - string `placeholder`: 提示符
    - boolean `multiple`: 是否支持多选，默认为 `false`；
- array `addon`: 添加 ajax 新建 option 的按钮
    - array | string `prepend`: 如果是数组，可以配置下面两个键：
        - string `content`: 一般为字体图标
        - boolean `asButton`: 默认值为 'false',
    - array | string `append`: 配置同 `prepend`;

一个最常见的配置实例：

```php
<?php
use kartik\widgets\Select2;
?>

<?= $form->field($model, 'customer_id')->widget(Select2::classname(), [
    'data' => User::mapCustomer(),
    'options' => ['placeholder' => '请选择'],
    'addon' => [
        'append' => [
            'content' => Html::button(Html::icon('plus'), [
                'class' => 'btn btn-default modal-create-customer', 
                'title' => '新建客户', 
                'data-toggle' => 'tooltip',
            ]),
            'asButton' => true
        ]
    ],
]) ?>
```

## 高阶

### 在 Modal 内动态显示 Select2

在 Modal 内使用 Select2 分两种情况：一种是 Modal 内容是静态生成，这种情况可以使用上面的 widget() 方法实现；另一种情况是下拉菜单通过 AJAX 动态生成，例如订单系统中的快速新建客户 Modal, 表单 HTML 内容是通过 AJAX 方法传递。这种情况使用 widget() 就不管用了。需要使用 Select2 原生的办法通过 `select2()` 实现。例如：

```js
var select2Config = {"theme":"krajee","width":"100%","placeholder":"请选择","language":"zh-CN"}
$('#address-country_id').select2(select2Config);
```

也就是说，HTML 表单还是用传统下拉菜单实现，传递到本地后，通过 `select2()` 更换样式。

#### Modal 内 Select2 无法搜索的问题

在 modal 内显示 Select2 有一个小问题——搜索功能失效。https://github.com/kartik-v/yii2-widget-select2/issues/41 提到 modal 的 `tabindex` 的值必须是 `false` 才可以。

```js
$('#customer-quick-cu-modal').modal({
    // ...
}).on('shown.bs.modal', function (e) {
    $('#customer-quick-cu-modal').attr('tabindex', false)
})
```
