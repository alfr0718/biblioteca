<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'tipo_usuario')->dropDownList([
    User::TIPO_PERSONA_EXTERNA => 'EXTERNO',
    User::TIPO_ESTUDIANTE => 'ESTUDIANTE',
    User::TIPO_DOCENTE => 'DOCENTE',
    ]) ?>

<!-- <?= $form->field($model, 'authkey')->textInput(['maxlength' => true]) ?> -->


    <?= $form->field($model, 'personaldata_correo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
