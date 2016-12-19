<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

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
            if ($pendiente) {
                echo Html::button('Solicitud de Amistad ya enviada', ['class' => 'btn btn-danger']);
            } else {
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
        echo Html::a('Buscar Contactos', ['/contactos/buscar-contacto'], ['class' => 'btn btn-default']) . "  ";
        echo Html::a('Ver lista de contactos', ['/contactos/listar-contactos'], ['class' => 'btn btn-default']) . "  ";
        echo Html::a('Ver solicitudes de amistad pendientes', ['/contactos/listar-solicitudes'], ['class' => 'btn btn-default']) . "  ";
    } ?>
</div>
