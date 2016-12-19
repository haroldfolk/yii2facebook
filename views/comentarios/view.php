<?php

use app\models\Usuarios;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Comentarios */

?>
<blockquote>
    <?= $model->contenido ?>

    <footer>

        <?= date_format(date_create($model->fecha_creacion), 'g:ia  j F Y') . " Por:" ?>
        <?= Usuarios::findOne(['id' => $model->usuario_id])->nombres . " " . Usuarios::findOne(['id' => $model->usuario_id])->apellidos ?>

        <?= Html::a('Editar Comentario', ['/publicacion/editar-comentario', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Borrar comentario', ['/publicacion/borrar-comentario', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </footer>
</blockquote>