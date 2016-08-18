<?php
use yii\bootstrap\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
?>


<header class="main-header">
    <?php
    NavBar::begin([
        'brandLabel' => '<b>My Co</b>mpany',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-static-top',
        ],
        //'innerContainerOptions' => [ 'class' => 'container-fluid', ],

    ]);
    $leftMenuItems = [
        [
            'label' => Html::icon('cog') . '&nbsp;设置',
            'encode' => false,
            'items' => [
                 ['label' => 'Lookup', 'url' => '/lookup/index'],
                 '<li class="divider"></li>',
                 //'<li class="dropdown-header">Dropdown Header</li>',
            ],
        ],
    ];
    if (YII_ENV_DEV) {    
        $leftMenuItems[] = ['label' => 'Gii', 'url' => ['/gii']];
    }

    $rightMenuItems = [
        [
            'label' => 'Home',
            'url' => ['site/index'],
        ],
        [
            'label' => 'Dropdown',
            'items' => [
                 ['label' => 'Level 1 - Dropdown A', 'url' => '#'],
                 '<li class="divider"></li>',
                 '<li class="dropdown-header">Dropdown Header</li>',
                 ['label' => 'Level 1 - Dropdown B', 'url' => '#'],
            ],
        ],
        [
            'label' => 'Login',
            'url' => ['site/login'],
            'visible' => Yii::$app->user->isGuest
        ],
    ];
    if (Yii::$app->user->isGuest) {
        $rightMenuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $rightMenuItems[] = [
            'label' => Html::icon('user') . '&nbsp;' . Yii::$app->user->identity->username,
            'encode' => false,
            'items' => [
                 [
                    'label' => '登出',
                    'url' => ['/site/logout'],
                    'linkOptions' => [
                        'data-method' => 'post',
                    ],
                ],
                 /*
                 '<li class="divider"></li>',
                 '<li class="dropdown-header">Dropdown Header</li>',
                 ['label' => 'Level 1 - Dropdown B', 'url' => '#'],
                 */
            ],
        ];
    }
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
