<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LibroSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="libro-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'codigo_barra') ?>

    <?= $form->field($model, 'n_ejemplares_libro') ?>

    <?= $form->field($model, 'num') ?>

    <?= $form->field($model, 'lib_asignatura') ?>

    <?= $form->field($model, 'lib_isbn') ?>

    <?php // echo $form->field($model, 'lib_nombre') ?>

    <?php // echo $form->field($model, 'lib_categoria') ?>

    <?php // echo $form->field($model, 'lib_autor') ?>

    <?php // echo $form->field($model, 'lib_editorial') ?>

    <?php // echo $form->field($model, 'lib_pais') ?>

    <?php // echo $form->field($model, 'lib_anio') ?>

    <?php // echo $form->field($model, 'lib_duplicado') ?>

    <?php // echo $form->field($model, 'lib_estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
