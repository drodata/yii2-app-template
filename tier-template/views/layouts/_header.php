<?php
use drodata\helpers\Html;
use yii\bootstrap\Nav;
use drodata\widgets\NavBar;
use backend\models\Lookup;
?>


<header class="main-header">
    <?php
    NavBar::begin([
        'brandLabel' => Html::tag('strong', Yii::$app->name),
        'brandUrl' => Yii::$app->homeUrl,
        'brandOptions' => [
            'title' => 'New Tier',
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
            'label' => Html::icon('plus'),
            'visible' => ! Yii::$app->user->isGuest,
            'encode' => false,
            'linkOptions' => [
                'title' => '新建……',
            ],
            'items' => [
                 ['label' => 'User', 'url' => '/user/create'],
                 '<li class="divider"></li>',
            ],
        ],
        [
            'visible' => YII_ENV_DEV,
            'label' => 'Test',
            'url' => ['/test/index'],
        ],
        [
            'visible' => YII_ENV_DEV,
            'label' => 'Gii',
            'url' => ['/gii'],
        ],
    ];

    echo Nav::widget([
        'items' => $leftMenuItems,
        'options' => ['class' => 'navbar-nav navbar-left'],
    ]);

    if (!Yii::$app->user->isGuest) {
        $rightMenuItems = [
            [
                'label' => Html::icon('flash'),
                'encode' => false,
                'visible' => YII_DEBUG && !Yii::$app->user->isGuest,
                'url' => ['/user/switch'],
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
            'items' => $rightMenuItems,
            'options' => ['class' => 'navbar-nav navbar-right'],
        ]);
    }

    NavBar::end();
    ?>
</header>
