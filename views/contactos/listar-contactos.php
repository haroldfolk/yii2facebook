<?php

use yii\grid\GridView;
use yii\helpers\Html;


echo "<h1>Lista de contactos</h1>";
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'nombres',
        'apellidos',
        'sexo',
        'username',
        'id' =>
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{/perfil/ver-perfil}',
                'buttons' => [
                    '/perfil/ver-perfil' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-user">VerContacto</span>', $url, [
                            'title' => 'Ver',
                        ]);

                    }
                ]
            ],
    ],

]);