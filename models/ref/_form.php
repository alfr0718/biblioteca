<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/** @var yii\web\View $this */
/** @var app\models\Libro $model */
/** @var yii\widgets\ActiveForm $form */
?>



<div class="row">
    <div class="col-md-6">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'codigo_barra')->label('Código de Barra')->textInput() ?>

        <?= $form->field($model, 'n_ejemplares_libro')->label('N° Ejemplares de Libros')->textInput() ?>

        <?= $form->field($model, 'num')->label('Número')->textInput() ?>

        <?= $form->field($model, 'lib_asignatura')->label('Tipo de Asignatura')->dropDownList([
            'Biología' => 'Biología',
            'Bioquímica' => 'Bioquímica',
            'Economía' => 'Deporte',
            'Educación Física' => 'Educación Física',
            'Deporte' => 'Deporte',
            'Matemática' => 'Matemática',
            'Mecánica' => 'Mecánica',
            'Medio Ambiente' => 'Medio Ambiente',
        ], ['prompt' => 'Selecciona una asignatura']) ?>

        <?= $form->field($model, 'lib_isbn')->label('ISBN')->textInput() ?>
        <?= $form->field($model, 'lib_nombre')->label('Nombre del Libro')->textInput() ?>

        <?= $form->field($model, 'lib_categoria')->label('Categoría')->dropDownList([
            'Libro' => 'Libro',
            'Diccionario' => 'Diccionario',
            'Revista' => 'Revista',
        ], ['prompt' => 'Selecciona una categoria']) ?>

        </div>
    <div class="col-md-6">
        <?= $form->field($model, 'lib_autor')->label('Autor del Libro')->textInput() ?>

        <?= $form->field($model, 'lib_editorial')->label('Editorial')->textInput() ?>

        <?= $form->field($model, 'lib_pais')->label('País')->dropDownList([
            'EC' => 'EC',
            'CO' => 'CO',
            'ES' => 'ES',
        ], ['prompt' => 'Selecciona un Pais']) ?>

        <?= $form->field($model, 'lib_anio')->label('Año de Publicación')->textInput()->input('date') ?>

        <?= $form->field($model, 'lib_duplicado')->label('Duplicado')->input('number') ?>

        <?= $form->field($model, 'lib_estado')->label('Estado')->dropDownList([
            'Disponible' => 'Disponible',
            'Prestado' => 'Prestado',
        ], ['prompt' => 'Selecciona un estado']) ?>

        <br>
        <div class="col-md-2 float-end">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>