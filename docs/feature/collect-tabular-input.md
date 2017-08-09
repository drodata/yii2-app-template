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
<div class="adjustWidget">
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

## 二 如何验证模型数据

:bell: 发现把这些过程写出来很麻烦，先放一放。
[related-section]: http://www.yiiframework.com/doc-2.0/guide-input-tabular-input.html#combining-update-create-and-delete-on-one-page

