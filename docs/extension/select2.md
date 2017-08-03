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

在 Modal 内使用 Select2 分两种情况：

- 借助 `yii\bootstrap\Modal` 在页面内直接显示；
- Modal 内容通过 AJAX 动态添加到 DOM 内，而后通过 JS 显示；

后一种情况必须使用 `renderAjax()` 才能正常显示，因为 Select widget 内涉及 registering assets.

#### Modal 内 Select2 无法搜索的问题

在 modal 内显示 Select2 有一个小问题——搜索功能失效。https://github.com/kartik-v/yii2-widget-select2/issues/41 提到 modal 的 `tabindex` 的值必须是 `false` 才可以。

```js
$('#customer-quick-cu-modal').modal({
    // ...
}).on('shown.bs.modal', function (e) {
    $(this).attr('tabindex', false)
})
```
