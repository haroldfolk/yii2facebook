<?php

use yii\grid\GridView;
use yii\helpers\Html;


?>
    <form action="buscar-contacto" class="form-inline">
        <input type="text" name="param" class="form-control">
        <input type="submit" value="Buscar Contacto" class="btn btn-primary">
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
            'template' => '{agregar}',
            'buttons' => [
                'agregar' => function ($url) {
                    return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, [
                        'title' => Yii::t('yii', 'Create'),
                    ]);

                }
            ]
        ],
    ],

]);