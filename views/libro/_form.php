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

    <?= $form->field($model, 'lib_cute')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lib_num')->textInput() ?>

    <?= $form->field($model, 'lib_isbn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lib_titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lib_autor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lib_editorial')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lib_aniopulic')->textInput() ?>

    <?= $form->field($model, 'lib_estado')->textInput() ?>

    <?= $form->field($model, 'paises_id_pais')->textInput() ?>

    <?= $form->field($model, 'asignatura_id_asignat')->textInput() ?>

    <?= $form->field($model, 'biblioteca_id_campus')->textInput() ?>

    <?= $form->field($model, 'categoria_id_categ')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
