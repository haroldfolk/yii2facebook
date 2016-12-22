<?php


use bsadnu\googlecharts\ColumnChart;

use bsadnu\googlecharts\PieChart;

echo "<h1>Estadisticas de Amigos <h3>(Sexo)</h3></h1><br><br>";
echo PieChart::widget([
    'id' => 'my-pie-chart-id',
    'data' => [
        ['Sex', 'Type'],
        ['Hombres', ($contadorHombres + $contadorMujeres / 100) * $contadorHombres],
        ['Mujeres', ($contadorHombres + $contadorMujeres / 100) * $contadorMujeres]
    ],
    'options' => [
        'fontName' => 'Verdana',
        'height' => 300,
        'width' => 500,
        'chartArea' => [
            'left' => 50,
            'width' => '90%',
            'height' => '90%'
        ],

    ]
]);
echo "<h1>Estadisticas de Solicitudes</h1><br><br>";
echo ColumnChart::widget([
    'id' => 'my-stacked-column-chart-id',
    'data' => [
        ['Solicitudes', 'Pendientes', 'Aceptadas'],
        ['Enviadas', $solicitudesEnviadasPendientes + 0, $solicitudesEnviadasYAceptadas + 0],
        ['Recibidas', $solicitudesRecibidasPendientes + 0, $solicitudesRecibidasYAceptadas + 0],

    ],
    'options' => [
        'fontName' => 'Verdana',
        'height' => 400,
        'fontSize' => 12,
        'chartArea' => [
            'left' => '5%',
            'width' => '50%',
            'height' => 350
        ],
        'isStacked' => true,
        'tooltip' => [
            'textStyle' => [
                'fontName' => 'Verdana',
                'fontSize' => 13
            ]
        ],
        'vAxis' => [
            'title' => 'Mis Solicitudes',
            'titleTextStyle' => [
                'fontSize' => 13,
                'italic' => false
            ],
            'gridlines' => [
                'color' => '#e5e5e5',
                'count' => 10
            ],
            'minValue' => 0
        ],
        'legend' => [
            'position' => 'top',
            'alignment' => 'center',
            'textStyle' => [
                'fontSize' => 12
            ]
        ]
    ]
]);
echo "<h1>Estadisticas de Comentarios y Likes</h1><br><br>";
echo ColumnChart::widget([
    'id' => 'my-column-chart-id',
    'data' => [
        ['Estado', 'Enviado', 'Recibido'],
        ['Likes', $likesRealizados + 0, $likesRecibidos + 0],
        ['Comentarios', $comentariosRealizados + 0, $comentariosRecibidos + 0],
    ],
    'options' => [
        'fontName' => 'Verdana',
        'height' => 400,
        'fontSize' => 12,
        'chartArea' => [
            'left' => '5%',
            'width' => '90%',
            'height' => 350
        ],
        'tooltip' => [
            'textStyle' => [
                'fontName' => 'Verdana',
                'fontSize' => 13
            ]
        ],
        'vAxis' => [
            'title' => '',
            'titleTextStyle' => [
                'fontSize' => 13,
                'italic' => false
            ],
            'gridlines' => [
                'color' => '#ffe5e5',
                'count' => 10
            ],
            'minValue' => 0
        ],
        'legend' => [
            'position' => 'top',
            'alignment' => 'center',
            'textStyle' => [
                'fontSize' => 12
            ]
        ]
    ]
])






?>



