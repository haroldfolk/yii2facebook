<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        if ($model->id == Yii::$app->user->id) {
            echo Html::a('Actualizar', ['perfil/editar-perfil', 'id' => $model->id], ['class' => 'btn btn-primary']);
        } else {
            if ($pendiente == 1) {
                echo Html::button('Solicitud de Amistad ya enviada', ['class' => 'btn btn-danger']);
            } else if ($pendiente == 0) {
                echo Html::a('Enviar solicitud de Amistad', ['contactos/enviar-solicitud', 'id' => $model->id], ['class' => 'btn btn-success']);
            } else if ($pendiente == -1) {
                echo Html::a('Enviar solicitud de Amistad', ['contactos/enviar-solicitud', 'id' => $model->id], ['class' => 'btn btn-success']);
            }

        }
        ?>

        <?= Html::a('Ir a Inicio', ['/inicio/ver-noticias'], ['class' => 'btn btn-warning']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombres',
            'apellidos',
            'username',
//            'password',
            'url:url',
//            'fecha_creacion',
            'fecha_nacimiento:date',
            'sexo',
        ],
    ]) ?>
    <?php if ($model->id == Yii::$app->user->id) {
        echo Html::a('Realizar Publicacion', ['/publicacion/realizar-publicacion'], ['class' => 'btn btn-success']) . "  ";
        echo Html::a('Buscar Contactos', ['/contactos/buscar-contacto'], ['class' => 'btn btn-default']) . "  ";
        echo Html::a('Ver lista de contactos', ['/contactos/listar-contactos'], ['class' => 'btn btn-default']) . "  ";
        echo Html::a('Ver solicitudes de amistad pendientes', ['/contactos/listar-solicitudes'], ['class' => 'btn btn-default']) . "  ";
    } ?>
    <?php echo ListView::widget([

        'dataProvider' => $dataProvider,


        'itemOptions' => ['class' => 'item'],

        'itemView' => function ($model, $key, $index, $widget) {

            return $this->render('/publicacion/viewNoticias', ['model' => $model]) . "<br><br>";

        },

    ]); ?>

</div>
