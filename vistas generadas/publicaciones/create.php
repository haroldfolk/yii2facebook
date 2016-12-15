<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Publicaciones */

$this->title = 'Create Publicaciones';
$this->params['breadcrumbs'][] = ['label' => 'Publicaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publicaciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
