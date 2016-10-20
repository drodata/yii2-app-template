# Select2

http://demos.krajee.com/widget-details/select2

## 配置

### 初阶

- array `data`: 适合使用 'yii\helpers\ArrayHelper::map()' 生成；
- string `theme`: 默认值：'krajee', 其它可选值：'default' (和 AdminLTE 更搭配一些), 'bootstrap' 和 'classic'
- array `options`: 
    - string `placeholder`: 提示符
- array `addon`: 添加 ajax 新建 option 的按钮
    - array | string `prepend`: 如果是数组，可以配置下面两个键：
        - string `content`: 一般为字体图标
        - boolean `asButton`: 默认值为 'false',
    - array | string `append`: 配置同 `prepend`;

一个最常见的配置实例：

```php
<?= $form->field($model, 'customer_id')->widget(Select2::classname(), [
    'data' => User::mapCustomer(),
    'options' => ['placeholder' => '请选择'],
    'addon' => [
        'append' => [
            'content' => Html::button(Html::icon('plus'), [
                'class' => 'btn btn-default modal-create-customer', 
                'title' => '新建客户', 
            ]),
            'asButton' => true
        ]
    ],
]) ?>
```

### 高阶
