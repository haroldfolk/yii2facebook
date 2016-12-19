<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\Publicaciones */
/* @var $model app\models\Usuarios */
$this->title = $model->titulo;

?>
<div class="publicaciones-view">

    <h1>Publicacion: <?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//        'id',
            'titulo',
            'contenido',
            'fecha_inicio:date',

        ],
    ]) ?>
    <div class="row">
        <div class="col-xs-8 col-sm-6">
            <h3><strong>Comentarios</strong></h3>
            <?php echo ListView::widget([
                'dataProvider' => $dataComentarios,
                'itemOptions' => ['class' => 'item'],
                'itemView' => function ($model) {
                    if ($model->usuario_id == Yii::$app->user->id) {
                        return $this->render('/comentarios/view', ['model' => $model]);
                    } else {
                        return $this->render('/comentarios/viewVisita', ['model' => $model]);
                    }
                },
            ]); ?>
            <form action="realizar-comentario" class="form-inline">
                <input type="text" name="param" class="form-control">
                <input type="hidden" name="id" class="form-control" value="<?= $model->id ?>">
                <input type="submit" value="Realizar comentario" class="btn btn-primary">
            </form>
            <br>
        </div>
        <div class="col-xs-4 col-sm-6">
            <h3><strong>Likes</strong></h3>

            <?php
            echo Html::a('<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>Like', ['/publicacion/dar-like', 'id' => $model->id], ['class' => 'btn btn-primary']);
            echo ListView::widget([
                'dataProvider' => $dataLikes,
                'itemOptions' => ['class' => 'item'],
                'itemView' => function ($model) {
                    return '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>' . $model->nombres . " " . $model->apellidos;
                },
            ]); ?>
        </div>
    </div>
