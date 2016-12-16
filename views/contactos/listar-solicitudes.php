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
    ],

]);