<?php
use app\models\Usuarios;
use yii\grid\GridView;
use yii\helpers\Html;

?>
<h1>Enviar Mensaje a:<?= $idU == null ? "" : Usuarios::findOne(['id' => $idU])->nombres ?></h1>
<?php if ($idU != null) { ?>

    <form action="enviar-inbox" class="form-inline">
        <input type="text" name="mensaje" class="form-control">
        <input type="hidden" name="id" class="form-control" value="<?= $idU ?>">
        <input type="submit" value="Enviar Mensaje" class="btn btn-primary">
    </form><br>
<?php } ?>

<div class="row">

    <?php

    if ($dataProvider != null){
    ?>
    <div class="col-xs-12 col-sm-6 col-md-6"><?php
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [

//		'contenido',
                [
                    'attribute' => 'contenido',
                    'value' => function ($model) {
                        if ($model->usuario_id == Yii::$app->user->id) {
                            return "<p align='right'><span class=\"label label-success\" >Yo:</span>" . $model->contenido . "</p>";
                        } else {
                            $usuario = Usuarios::findOne(['id' => $model->usuario_id]);
                            return "<p ><span class=\"label label-warning\" >" . $usuario->nombres . ":</span>" . $model->contenido . "</p>";
                        }

                    },
                    'format' => 'html'

                ]


            ],

        ]);
        }
        ?>    </div>

    <div class="col-xs-6 col-md-6">
        <?php
        if ($dataProvider2 != null) {
            echo "<h3>Lista de amigos</h3>";
            echo GridView::widget([
                'dataProvider' => $dataProvider2,
                'columns' => [
                    'id',
                    'nombres',
                    'apellidos',
                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '{enviar-inbox}',
                        'buttons' => [
                            'enviar-inbox' => function ($url) {
                                return Html::a('<button><span class="glyphicon glyphicon-envelope"> </span>Enviar Mensaje</button>', $url, [
                                    'title' => 'Enviar un mensaje',
                                ]);

                            }
                        ]
                    ],
                ],

            ]);
        }
        ?>
    </div>
</div>
