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
            'linkOptions' => [
                'title' => '设置',
            ],
            'items' => [
                 ['label' => 'Lookup', 'url' => '/lookup/index'],
                 '<li class="divider"></li>',
            ],
        ],
        [
            'label' => Html::icon('plus'),
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
            'label' => 'WeUI',
            'url' => ['/weui/index'],
        ],
        [
            'visible' => YII_ENV_DEV && Yii::$app->user->can('admin'),
            'label' => 'Test',
            'url' => ['/test/index'],
        ],
        [
            'visible' => YII_ENV_DEV && Yii::$app->user->can('admin'),
            'label' => 'Gii',
            'url' => ['/gii'],
        ],
    ];

    $rightMenuItems = [
        [
            'label' => 'Demo',
            'items' => [
                 ['label' => 'Select2', 'url' => '/demo/select2', 'encode' => false],
                 ['label' => 'Box', 'url' => '/demo/box', 'encode' => false],
                 ['label' => Html::fwicon('line-chart') . 'Chart.js', 'url' => '/demo/chartjs', 'encode' => false],
                 ['label' => 'Tabs', 'url' => '/demo/tabs', 'encode' => false],
                 '<li class="divider"></li>',
                 '<li class="dropdown-header">Dropdown Header</li>',
                 ['label' => 'Level 1 - Dropdown B', 'url' => '#'],
            ],
        ],
        [
            'label' => '用户',
            'url' => ['user/index'],
        ],
        [
            'label' => '登录',
            'url' => ['site/login'],
            'visible' => Yii::$app->user->isGuest,
        ],
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
