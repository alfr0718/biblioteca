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

    <?= $form->field($model, 'Descripcion')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'Status')->textInput() ?>

    <?= $form->field($model, 'idcategoria')->dropDownList(
        yii\helpers\ArrayHelper::map(\app\models\Categoria::find()->all(), 'id', 'Nombre'),
        ['prompt' => 'Selecciona categoria']
    ) ?>

    <?= $form->field($model, 'idpais')->dropDownList(
        yii\helpers\ArrayHelper::map(\app\models\Pais::find()->all(), 'id', 'Nombre'),
        ['prompt' => 'Selecciona un país']
    ) ?>

    <?= $form->field($model, 'idasignatura')->dropDownList(
        yii\helpers\ArrayHelper::map(\app\models\Asignatura::find()->all(), 'id', 'Nombre'),
        ['prompt' => 'Selecciona asignatura']
    ) ?>

    <?= $form->field($model, 'portadaFile')->fileInput() ?>

    <?= $form->field($model, 'docFile')->fileInput() ?>

    <?php // $form->field($model, 'portada')->textInput() 
    ?>

    <?php // $form->field($model, 'doc')->textInput() 
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>