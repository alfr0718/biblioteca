<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Resetear contraseña';
$this->params['breadcrumbs'][] = $this->title;

// Yii flash error

?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-3">
                <div class="card-header bg-primary text-white">
                    <h1 class="text-center">
                        <?= Html::encode($this->title) ?>
                    </h1>
                </div>
                <div class="card-body">
                    

                    <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                    <?= $form->errorSummary($model) ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Ingrese el número de cédula de usuario') ?>

                    <div class="form-group">
                        <?= Html::submitButton('<i class="fas fa-check"></i>', ['class' => 'btn btn-primary btn-circle', 'name' => 'change-password-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>