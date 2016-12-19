<?php

use app\models\Usuarios;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Publicaciones */
$autor = Usuarios::findOne(['id' => $model->autor_id])->nombres . " " . Usuarios::findOne(['id' => $model->autor_id])->apellidos;
$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Publicaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="publicaciones-view">

        <h1><?= Html::encode($this->title) ?>
            <small>Autor: <?= $autor ?></small>
        </h1>

        <p>
            <?= $model->contenido ?>

        </p>
        <button class="btn btn-default">Fecha de publicacion:<span class="badge"><?= $model->fecha_inicio ?></span>
        </button>
        <button class="btn btn-default">#Comentarios:<span class="badge"><?= $model->getComentarios()->count() ?></span>
        </button>
        <button class="btn btn-default">#Likes:<span class="badge"><?= $model->getLikes()->count() ?></span></button>

    </div>
<?= "<br>" . Html::a('Ver publicacion Completa', ['/publicacion/ver-publicacion', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>