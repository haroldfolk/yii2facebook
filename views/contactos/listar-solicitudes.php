<?php

use yii\grid\GridView;
use yii\helpers\Html;


echo "<h1>Lista de Solicitudes</h1>";
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'nombres',
        'apellidos',
        ['class' => 'yii\grid\ActionColumn',
            'template' => '{/contactos/aceptar-solicitud}',
            'buttons' => [
                '/contactos/aceptar-solicitud' => function ($url) {

                    return Html::a('<span class="glyphicon glyphicon-ok">Aceptar Solicitud</span>', $url, [
                        'title' => 'Aceptar',
                    ]);

                }
            ]
        ],
        ['class' => 'yii\grid\ActionColumn',
            'template' => '{/contactos/rechazar-solicitud}',
            'buttons' => [
                '/contactos/rechazar-solicitud' => function ($url) {

                    return Html::a('<span class="glyphicon glyphicon-remove">Rechazar Solicitud</span>', $url, [
                        'title' => 'Aceptar',
                    ]);

                }
            ]
        ],
    ],

]);