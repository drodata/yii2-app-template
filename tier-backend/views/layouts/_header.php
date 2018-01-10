<?php
use drodata\helpers\Html;
use yii\bootstrap\Nav;
use drodata\widgets\NavBar;
?>


<header class="main-header">
    <?php
    NavBar::begin([
        'brandLabel' => Html::tag('strong', Yii::$app->name),
        'brandUrl' => Yii::$app->homeUrl,
        'brandOptions' => [
            'title' => 'Yii2 Application Template (by drodata)',
            'data' => [
                'toggle' => 'tooltip',
                'placement' => 'bottom',
            ],
        ],
        'options' => [
            'class' => 'navbar navbar-static-top',
        ],
        //'innerContainerOptions' => [ 'class' => 'container-fluid', ],

    ]);
    $leftMenuItems = [
        [
            'label' => Html::icon('cog'),
            'encode' => false,
            'visible' => ! Yii::$app->user->isGuest,
            'linkOptions' => [
                'title' => '设置',
            ],
            'items' => [
                [
                    'encode' => false,
                    'label' => Html::fwicon('user') . '用户',
                    'url' => '/user/index',
                ],
                ['label' => 'Lookup', 'url' => '/lookup/index'],
                '<li class="divider"></li>',
                ['label' => 'Notification', 'url' => '/notification/'],
            ],
        ],
        [
            'label' => Html::icon('plus'),
            'visible' => ! Yii::$app->user->isGuest,
            'encode' => false,
            'linkOptions' => [
                'title' => '新建……',
            ],
            'items' => [
                 ['label' => '用户', 'url' => '/user/create'],
                 '<li class="divider"></li>',
            ],
        ],
        [
            'label' => Html::icon('book'),
            'visible' => !Yii::$app->user->isGuest && YII_ENV_DEV,
            'encode' => false,
            'items' => [
                 ['label' => 'Select2', 'url' => '/demo/category/select2', 'encode' => false],
                 ['label' => '临时商品', 'url' => '/demo/manage-product', 'encode' => false],
                 [ 'label' => 'WeUI', 'url' => ['/weui/index'], ],
                 ['label' => Html::fwicon('line-chart') . 'Chart.js', 'url' => '/demo/category/chartjs', 'encode' => false],
                 ['label' => 'Tabs', 'url' => '/demo/category/tabs', 'encode' => false],
                 '<li class="divider"></li>',
                 ['label' => Html::fwicon('flag') . 'FontAwesome', 'url' => '/demo/category/fontawesome', 'encode' => false],
                 '<li class="divider"></li>',
                 '<li class="dropdown-header">Dropdown Header</li>',
                 ['label' => 'Level 1 - Dropdown B', 'url' => '#'],
            ],
        ],
        [
            'visible' => !Yii::$app->user->isGuest && YII_ENV_DEV,
            'label' => 'Test',
            'url' => ['/test/index'],
        ],
        [
            'visible' => !Yii::$app->user->isGuest && YII_ENV_DEV,
            'label' => 'Gii',
            'url' => ['/gii'],
        ],
    ];

    $rightMenuItems = [
        [
            'label' => Html::icon('user') . '&nbsp;' . Yii::$app->user->identity->username,
            'encode' => false,
            'visible' => !Yii::$app->user->isGuest,
            'items' => [
                 [
                    'label' => '账户信息',
                    'url' => ['/user/profile'],
                ],
                 '<li class="divider"></li>',
                 [
                    'label' => '登出',
                    'url' => ['/site/logout'],
                    'linkOptions' => [
                        'data-method' => 'post',
                    ],
                ],
            ],
        ],
    ];
    echo Nav::widget([
        'items' => $leftMenuItems,
        'options' => ['class' => 'navbar-nav navbar-left'],
    ]);
    echo Nav::widget([
        'items' => $rightMenuItems,
        'options' => ['class' => 'navbar-nav navbar-right'],
    ]);
    NavBar::end();
    ?>
</header>
