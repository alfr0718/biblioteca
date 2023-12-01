<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">¡Bienvenido!</h1>
                                    </div>

                                    <?php $form = ActiveForm::begin([
                                        'id' => 'login-form',
                                        'layout' => 'horizontal',
                                        'fieldConfig' => [
                                            'errorOptions' => ['class' => 'invalid-feedback'],
                                        ],
                                    ]); ?>

                                    <?= $form->field($model, 'username')->textInput([
                                        'autofocus' => true,
                                        'placeholder' => 'Ingresa tu usuario...',
                                        'class' => 'form-control form-control-user'
                                    ])->label(false) ?>

                                    <?= $form->field($model, 'password')->passwordInput([
                                        'placeholder' => 'Password',
                                        'class' => 'form-control form-control-user'
                                    ])->label(false) ?>

                                    <?= $form->field($model, 'rememberMe')->checkbox([
                                        'class' => 'custom-control-input',
                                        'id' => 'customCheck'
                                    ])->label('Remember Me', ['class' => 'custom-control-label']) ?>

                                    <?= Html::submitButton('Iniciar Sesión', [
                                        'class' => 'btn btn-primary btn-user btn-block',
                                        'name' => 'login-button'
                                    ]) ?>

                                    <?php ActiveForm::end(); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>
