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
<?php

?>
<div class="row">

    <?php

    if ($dataProvider != null){
    ?>
    <div class="col-xs-12 col-sm-6 col-md-8"><?php
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [

//		'contenido',
                [
                    'attribute' => 'contenido',
                    'value' => function ($model) {
                        if ($model->usuario_id == Yii::$app->user->id) {
                            return "<blockquote class='blockquote-reverse'>Yo:" . $model->contenido . "</blockquote>";
                        } else {
                            $usuario = Usuarios::findOne(['id' => $model->usuario_id]);
                            return "<blockquote>" . $usuario->nombres . ":" . $model->contenido . "</blockquote>";
                        }

                    },
                    'format' => 'html'
                ]


            ],

        ]);
        }
        ?>    </div>

    <div class="col-xs-6 col-md-4">
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
                                return Html::a('<span class="glyphicon glyphicon-envelope"></span>', $url, [
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
