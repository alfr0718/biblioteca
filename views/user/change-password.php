<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Cambiar Contraseña';
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-change-password">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php if (isset($mensaje)) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>¡Éxito!</strong> <?= $mensaje ?>
        </div>
    <?php endif; ?>

    <?php if (isset($error)) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> <?= $error ?>
        </div>
    <?php endif; ?>
    
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'currentPassword')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'newPassword')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'confirmPassword')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('<span class="icon text-white-50"><i class="fas fa-lock"></i></span><span class="text">Cambiar Contraseña</span>', ['class' => 'btn btn-success btn-icon-split']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>