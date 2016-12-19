<?php

use yii\grid\GridView;
use yii\helpers\Html;


?>
    <form action="buscar-personas" class="form-inline">
        <input type="text" name="param" class="form-control">
        <input type="submit" value="Buscar Personas" class="btn btn-primary">
    </form><br>
<?php


echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'nombres',
        'apellidos',
        'sexo',
        'username',
        ['class' => 'yii\grid\ActionColumn',
            'template' => '{/perfil/ver-perfil}',
            'buttons' => [
                '/perfil/ver-perfil' => function ($url) {
                    return Html::a('<span class="glyphicon glyphicon-plus" > VerPerfil</span>', $url, [
                        'title' => Yii::t('yii', 'Ver perfil de usuario'), 'class' => 'btn btn-primary'
                    ]);

                }
            ]
        ],
    ],

]);
