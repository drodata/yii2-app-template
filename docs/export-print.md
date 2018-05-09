# 页面内直接打印

借助 jQuery jqprint 插件，可以打印 DOM 中局部内容。页面内直接打印的思路很简单：借助 AJAX 把需要打印的内容发送到 DOM 内，使用 `.jqprint()` 触发。此插件已集成在 `drodata\jqprint\PrintAsset` 内。

## 一键打印实例

```php
<?php
// 视图文件

drodata\jqprint\PrintAsset::register($this);

$js = <<<JS
$('.print-button').click(function(){
    $('.print-container').jqprint()
})
JS;
$this->registerJs($js);

?>

<?= Html::button('打印', ['class' => 'btn btn-primary print-button']) ?>

<div class="print-container visible-print-block">
    这里放置需要打印内容，可以使用 Bootstrap 样式，简单方便
</div>
```

## AJAX 表单提交打印范例

[代码链接](https://github.com/drodata/yii2-app-template/blob/master/tier-backend/views/demo/print.php#L29)
