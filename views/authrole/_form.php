<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Authrole $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="authrole-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Name_role')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Created_at')->textInput() ?>

    <?= $form->field($model, 'Updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
