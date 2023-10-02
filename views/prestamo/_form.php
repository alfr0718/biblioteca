<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Prestamo $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="prestamo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecha_pedido')->textInput() ?>

    <?= $form->field($model, 'tiempo_solicitado')->textInput() ?>

    <?= $form->field($model, 'tipoprestamo_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'biblioteca_idbiblioteca')->textInput() ?>

    <?= $form->field($model, 'pc_idpc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pc_biblioteca_idbiblioteca')->textInput() ?>

    <?= $form->field($model, 'libro_codigo_barras')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'libro_biblioteca_idbiblioteca')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
