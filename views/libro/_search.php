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

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'Titulo') ?>

    <?= $form->field($model, 'Autor') ?>

    <?= $form->field($model, 'Editorial') ?>

    <?= $form->field($model, 'Anio') ?>

    <?php // echo $form->field($model, 'Isbn') ?>

    <?php // echo $form->field($model, 'N_clasificacion') ?>

    <?php // echo $form->field($model, 'Descripcion') ?>

    <?php // echo $form->field($model, 'Status') ?>

    <?php // echo $form->field($model, 'idcategoria') ?>

    <?php // echo $form->field($model, 'idpais') ?>

    <?php // echo $form->field($model, 'idasignatura') ?>

    <?php // echo $form->field($model, 'portada') ?>

    <?php // echo $form->field($model, 'doc') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>