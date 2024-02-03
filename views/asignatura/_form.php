<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Asignatura $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="asignatura-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idcar')->dropDownList(
        yii\helpers\ArrayHelper::map(\app\models\Carrera::find()->all(), 'idcar', 'Nombre'),
        ['prompt' => 'Selecciona asignatura']
    ) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>