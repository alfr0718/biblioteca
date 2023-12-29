<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Iniciar Sesión';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-login" style="height: 100vh;">
    <!-- Outer Row -->
    <div class="row justify-content-center" style="height: 100%;">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block" style="background-image: url('<?= Yii::getAlias('@web') ?>/img/login.webp'); background-size: cover; background-position: center;">
                            <!-- Contenido del div (si es necesario) -->
                        </div>

                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">¡Bienvenido!</h1>
                                </div>
                                <?php $form = ActiveForm::begin([
                                    'id' => 'login-form',
                                    'fieldConfig' => [
                                        'template' => "{label}\n{input}\n{error}",
                                        'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                                        'inputOptions' => ['class' => 'col-lg-3 form-control'],
                                        'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                                    ],
                                    'options' => ['class' => 'user']
                                ]); ?>

                                <?= $form->field($model, 'username', ['options' => ['class' => 'form-group']])->label(false)
                                    ->textInput(['class' => 'form-control form-control-user', 'placeholder' => 'Usuario']) ?>

                                <?= $form->field($model, 'password', ['options' => ['class' => 'form-group']])->label(false)
                                    ->passwordInput(['class' => 'form-control form-control-user', 'placeholder' => 'Contraseña']) ?>

                                <?= $form->field($model, 'rememberMe')->checkbox([
                                    'class' => 'custom-control-input', // Aplica estilo al input del checkbox
                                    'template' => '<div class="custom-control custom-checkbox small">{input}{label}</div>',
                                ])->label('Recuérdame', ['class' => 'custom-control-label']) ?>

                                <div class="form-group">
                                    <?= Html::submitButton('Iniciar Sesión', ['class' => 'btn btn-primary btn-user btn-block']) ?>
                                </div>

                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>