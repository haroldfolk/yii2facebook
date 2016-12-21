<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Publicaciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="publicaciones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contenido')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model2, 'imageFile')->fileInput(['accept' => 'image/*']) ?>
    <?= $form->field($model, 'fecha_inicio')->textInput(['maxlength' => true]) ?>



    <?php
    $model->fecha_inicio = null;
    $model->fecha_fin = null;
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
