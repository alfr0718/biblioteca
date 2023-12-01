<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Datospersonales $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="datospersonales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'photofile')->fileInput(['class' => 'form-control-file'])->label('Foto de Perfil') ?>

    <?= $form->field($model, 'Ci')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ApellidoPaterno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ApellidoMaterno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nombres')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'Email')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'Status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-check"></i>', ['class' => 'btn btn-success btn-circle']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>