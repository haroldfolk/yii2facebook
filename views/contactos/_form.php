<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Amigos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="amigos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'esta_aceptado')->checkbox() ?>

    <?= $form->field($model, 'fecha_creacion')->textInput() ?>

    <?= $form->field($model, 'apodo_emisor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apodo_receptor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emisor_id')->textInput() ?>

    <?= $form->field($model, 'receptor_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
