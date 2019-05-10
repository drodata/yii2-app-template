# 表单元素改变时动态获取相关数据的技巧

在使用表单搜集数据时，一个常见的情形是：一个表单元素的变化会动态改变其它元素的状态。以 EIMS 中新建订单表单为例，表单需要搜集客户名称和客户的收货地址，分别使用下拉菜单和单选框表示。收货地址取决于选择的客户：当用户选择某个客户时， jQuery 通过 ajax 获得该客户的所有地址，在服务端组装出对应的 HTML 代码（这里是单选框），发送到客户端。jQuery 进行相应的逻辑实现（例如更新 DOM）。

## 通常的做法

以上面的新建订单表单为例，首先在客户控制器内声明一个 fetch-change-data 动作， 借助 jQuery $.get(), 携带当前选择的客户 ID, 向路由 customer/fetch-change-data 发起请求，

单从这一个场景来看，此做法没有问题。考虑到这是一个常见的场景，其它表单也会有类似的需求，如果每一次都在对应的控制器内声明一个 fetch-change-data action, 会出现代码重复，因为每个 action 的内容几乎一样。这里可以进一步抽象，让代码变得更通用、更精简。

## 更优雅的做法

YAT 模板内都有一个 SiteController, 可以考虑将通用动作放在这里。下面以 EIMS 中新建付款申请表单为例，用这种办法实现。付款申请表单需要搜集供应商名称和供应商的付款账户，后者的内容取决于前者。相关代码片段如下：

### site/fetch-change-data action

```php
public function actionFetchChangeData()
{
    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    // 限定客户端只能通过 POST 发送请求
    return Lookup::fetchChangeData(Yii::$app->request->post());
}
```

### 客户端发送请求

客户端携带的参数主要有 key 和 id, 前者区分各种场景，后者是用户当前选中的值。

```js
cost.seller_id.change(function () {
    var activeValue = $(this).val()
    var url = APP.baseUrl + 'site/fetch-change-data'
        , data = {key: 'seller', id: activeValue}
    $.post(url, data, function(response) {
        cost.receiver_account_id.html( response.accountOption ).trigger('change')
    }).fail(ajax_fail_handler).always(function(){
    });
});
```


### 服务端拼装过程封装在 Lookup::fetchChangeData() 内

Lookup 类也是 YAT 模板内公用的类，拼装过程适合放在这里。

```php
public static function fetchChangeData($configs)
{
    $key = ArrayHelper::remove($configs, 'key');
    $id = ArrayHelper::remove($configs, 'id');
    switch ($key) {
        case 'seller':
            $accounts = Account::find()->where(['seller_id' => $id])->all();
            $options = [Html::tag('option', '请选择', ['value' => ''])];

            if ($accounts) {
                foreach ($accounts as $account) {
                    $options[] = Html::tag('option', $account->getDescription(), ['value' => $account->id]);
                }
            }
            return [
                'accountOption' => implode('', $options),
            ];
            break;
    }
}
```

## 小结

我们做了两处抽象：负责处理请求的 site/fetch-change-data action, 和处理拼装逻辑的 `Lookup::fetchChangeData()`. 再碰到类似的场景，只需要在客户端发送请求代码部分和 `Lookup::fetchChangeData()` 内填充逻辑代码即可。代码变得精简且逻辑清晰。
