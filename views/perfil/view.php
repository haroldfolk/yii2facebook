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
        <?= Html::a('Actualizar', ['perfil/editar-perfil', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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

</div>
