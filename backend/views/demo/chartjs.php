<?php
use drodata\helpers\Html;
use drodata\widgets\Box;
use \common\widgets\ChartJs;

/* @var $this yii\web\View */

$this->title = 'Chart.js';
$this->params = [
    'title' => $this->title,
    'breadcrumbs' => [
        ['label' => 'Index', 'url' => 'index'],
        $this->title,
    ],
];

?>
<div class="row">
    <div class="col-md-8 col-sm-12">
        <?php
        Box::begin([
            'title' => 'First',
            'tools' => [
                'collapse',
            ],
        ]);
        ?>
<?= ChartJs::widget([
    'type' => 'line',
    'options' => [
        'height' => 108,
        'width' => 470,
    ],
    'data' => [
        'labels' => ["January", "February", "March", "April", "May", "June"],
        'datasets' => [
            [
                'label' => '微粉',
                'fill' => true,
                'lineTension' => 0.3,
                'data' => [12, 19, 3, 5, 2, 3],
                'backgroundColor' =>  'rgba(255, 99, 132, 0.2)',
                'borderColor' => 'rgba(255, 99, 132, 0.6)',
                'borderWidth' => 2,
                'pointStyle' => false,//'rect',
            ],
            [
                'label' => '研磨膏',
                'fill' => true,
                'data' => [5, 2, 3, 12, 19, 3],
                'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                'borderColor' => 'rgba(75, 192, 192, 1)',
                'borderWidth' => 1,
            ],
            [
                'label' => '破碎料',
                'fill' => true,
                'data' => [0, 2, 8, 12, 9, 13],
                'backgroundColor' => 'rgba(153, 102, 255, 0.2)',
                'borderColor' => 'rgba(153, 102, 255, 1)',
                'borderWidth' => 1,
                'pointBorderWidth' => 1,
            ],
        ],
    ],
    'clientOptions' => [
        'elements' => [
            'point' => [
                'radius' => 0,
            ],
        ],
        'hover' => [
            //'mode' => 'dataset',
        ],
        // 图标说明文字
        'legend' => [
            'display' => true,
            'position' => 'top',
        ],
        'scaleStepsWidth' => 8,
        'scales' => [
            'xAxes' => [
                [
                    'gridLines' => [
                        'display' => false,
                    ],
                ],
            ],
            'yAxes' => [
                [
                    'gridLines' => [
                        'display' => false,
                    ],
                ],
            ],
        ],
    ],
]) ?>
        <?php Box::end();?>
    </div>
    <div class="col-lg-6 col-md-12 hide">
        <?php
        Box::begin([
            'title' => 'First',
            'tools' => [
                'collapse',
            ],
        ]);
        ?>
            <?= ChartJs::widget([
                'type' => 'bar',
                'data' => [
                    'labels' => ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                    'datasets' => [[
                        'label' => '# of Votes',
                        'data' => [12, 19, 3, 5, 2, 3],
                        'backgroundColor' =>  [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)' 
                        ],
                        'borderColor' => [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        'borderWidth' => 1,
                    ]]
                ],
                'clientOptions' => [],
            ]) ?>
        <?php Box::end();?>
    </div>
</div>
