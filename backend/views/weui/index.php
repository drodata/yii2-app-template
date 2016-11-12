<?php
use common\weui\Html;
use common\weui\Message;
use common\weui\Panel;

/* @var $this yii\web\View */
$src = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHgAAAB4CAMAAAAOusbgAAAAeFBMVEUAwAD///+U5ZTc9twOww7G8MYwzDCH4YcfyR9x23Hw+/DY9dhm2WZG0kbT9NP0/PTL8sux7LFe115T1VM+zz7i+OIXxhes6qxr2mvA8MCe6J6M4oz6/frr+us5zjn2/fa67rqB4IF13XWn6ad83nxa1loqyirn+eccHxx4AAAC/klEQVRo3u2W2ZKiQBBF8wpCNSCyLwri7v//4bRIFVXoTBBB+DAReV5sG6lTXDITiGEYhmEYhmEYhmEYhmEY5v9i5fsZGRx9PyGDne8f6K9cfd+mKXe1yNG/0CcqYE86AkBMBh66f20deBc7wA/1WFiTwvSEpBMA2JJOBsSLxe/4QEEaJRrASP8EVF8Q74GbmevKg0saa0B8QbwBdjRyADYxIhqxAZ++IKYtciPXLQVG+imw+oo4Bu56rjEJ4GYsvPmKOAB+xlz7L5aevqUXuePWVhvWJ4eWiwUQ67mK51qPj4dFDMlRLBZTqF3SDvmr4BwtkECu5gHWPkmDfQh02WLxXuvbvC8ku8F57GsI5e0CmUwLz1kq3kD17R1In5816rGvQ5VMk5FEtIiWislTffuDpl/k/PzscdQsv8r9qWq4LRWX6tQYtTxvI3XyrwdyQxChXioOngH3dLgOFjk0all56XRi/wDFQrGQU3Os5t0wJu1GNtNKHdPqYaGYQuRDfbfDf26AGLYSyGS3ZAK4S8XuoAlxGSdYMKwqZKM9XJMtyqXi7HX/CiAZS6d8bSVUz5J36mEMFDTlAFQzxOT1dzLRljjB6+++ejFqka+mXIe6F59mw22OuOw1F4T6lg/9VjL1rLDoI9Xzl1MSYDNHnPQnt3D1EE7PrXjye/3pVpr1Z45hMUdcACc5NVQI0bOdS1WA0wuz73e7/5TNqBPhQXPEFGJNV2zNqWI7QKBd2Gn6AiBko02zuAOXeWIXjV0jNqdKegaE/kJQ6Bfs4aju04lMLkA2T5wBSYPKDGF3RKhFYEa6A1L1LG2yacmsaZ6YPOSAMKNsO+N5dNTfkc5Aqe26uxHpx7ZirvgCwJpWq/lmX1hA7LyabQ34tt5RiJKXSwQ+0KU0V5xg+hZrd4Bn1n4EID+WkQdgLfRNtvil9SPfwy+WQ7PFBWQz6dGWZBLkeJFXZGCfLUjCgGgqXo5TuSu3cugdcTv/HjqnBTEMwzAMwzAMwzAMwzAMw/zf/AFbXiOA6frlMAAAAABJRU5ErkJggg==';

$this->title = 'WeUI Demo';

$css = <<<CSS
.icon-lg { font-size: 93px;}
.text-success {color: #09BB07 !important;}
.text-info {color: #10AEFF !important;}
.text-danger {color: #F43530 !important;}
.text-muted {color: #B2B2B2 !important;}
CSS;
$this->registerCss($css);

$js = <<<JS
$('.gogo').click(function() {
    $.weui.alert('good.');
});
JS;
$this->registerJs($js);

$a = Html::button('ago', [
    'class' => 'btn btn-default gogo',
]);


?>
<div class="page__hd">
        <h1 class="page__title">Preview</h1>
        <p class="page__desc">表单预览</p>
    </div>

<?= Panel::widget([
    'title' => '订单详情',
    'footerButtons' => [
        Html::a('确认订单', '#', ['class' => 'weui-form-preview__btn weui-form-preview__btn_primary'])
    ],
    'items' => [
        [
            'type' => 'thumbnail',
            'src' => $src,
            'title' => 'Hello',
            'desc' => 'good good study',
        ],
        [
            'type' => 'thumbnail',
            'src' => $src,
            'title' => 'Google inc.',
            'desc' => 'good good study',
        ],
        [
            'type' => 'text',
            'title' => 'What a Beautiful Article It is',
            'desc' => 'good good study',
        ],
        [
            'type' => 'text',
            'title' => 'Part II What a Beautiful Article It is',
            'desc' => 'good good study',
        ],
        [
            'type' => 'icon',
            'src' => $src,
            'title' => 'Hello',
            'desc' => 'good good study',
        ],
        [
            'type' => 'icon',
            'src' => $src,
            'title' => 'Hello',
            'desc' => 'good good study',
            'linkOptions' => [
                'data-id' => 33,
            ],
        ],
    ],
]) ?>

<?= Panel::widget([
    'title' => 'Preference Setting',
    'items' => [
        [
            'type' => 'icon',
            'src' => $src,
            'title' => 'Hello',
            'desc' => 'good good study',
        ],
        [
            'type' => 'icon',
            'src' => $src,
            'title' => 'Hello',
            'desc' => 'good good study',
        ],
    ],
]) ?>

<div style="padding:15px;">
<?= Html::a('批量确认所有订单', '#', ['class' => 'btn btn-success']) ?>
</div>
