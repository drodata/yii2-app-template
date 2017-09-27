<?= \common\widgets\ChartJs::widget([
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
