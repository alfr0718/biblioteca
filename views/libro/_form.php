<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Libro $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="libro-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigo_barra')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'n_ejemplares_libro')->textInput() ?>

    <?= $form->field($model, 'num')->textInput() ?>

    <?= $form->field($model, 'lib_asignatura')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lib_isbn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lib_nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lib_categoria')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lib_autor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lib_editorial')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lib_pais')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lib_anio')->textInput() ?>

    <?= $form->field($model, 'lib_duplicado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lib_estado')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
