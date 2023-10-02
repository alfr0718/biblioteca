<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'Username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Status')->dropDownList([
            0 => 'Inactive',
            1 => 'Active',
        ]) ?>
        

    <?php // $form->field($model, 'Auth_key')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'Status')->textInput() ?>

    <?php // $form->field($model, 'Created_at')->textInput() ?>

    <?php // $form->field($model, 'Updated_at')->textInput() ?>

    <?php // $form->field($model, 'Temporalpassword')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'Tempralpasswordtime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success bg-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>