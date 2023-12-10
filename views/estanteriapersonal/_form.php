<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Estanteriapersonal $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="estanteriapersonal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'estanteria_id')->textInput() ?>

    <?= $form->field($model, 'libro_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
