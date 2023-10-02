<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Authassignmentrole $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="authassignmentrole-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idusername')->textInput() ?>

    <?= $form->field($model, 'role_id')->textInput() ?>

    <?= $form->field($model, 'Created_at')->textInput() ?>

    <?= $form->field($model, 'Updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
