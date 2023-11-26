<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Libro $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="libro-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Autor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Editorial')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Anio')->textInput() ?>

    <?= $form->field($model, 'Isbn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'N_clasificacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Status')->textInput() ?>

    <?= $form->field($model, 'idcategoria')->textInput() ?>

    <?= $form->field($model, 'idpais')->textInput() ?>

    <?= $form->field($model, 'idasignatura')->textInput() ?>
    
    <?= $form->field($model, 'portadaFile')->fileInput() ?>
    
    <?= $form->field($model, 'docFile')->fileInput() ?>

    <?= $form->field($model, 'portada')->textInput() ?>

    <?= $form->field($model, 'doc')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>