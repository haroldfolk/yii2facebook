<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    <img src="<?= $model->url ?>" alt="Imagen" height="200" width="200">
    <?= $form->field($model2, 'imageFile')->fileInput(['accept' => 'image/*']) ?>
    <?= $form->field($model, 'fecha_nacimiento')->widget(DatePicker::classname(), [
        'language' => 'es',
        'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'sexo')->dropDownList(['F' => 'Femenino', 'M' => 'Masculino'], ['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
