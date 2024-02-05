<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */

$authManager = Yii::$app->authManager;

// Obtener todos los roles disponibles
$roles = $authManager->getRoles();

// Obtener los nombres de los roles para usar en el DropDownList
$rolesList = ArrayHelper::map($roles, 'name', 'name');
?>

<div class="user-form">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-center">
            <h1 class="m-0 font-weight-bold text-primary"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'readonly' => $isUpdated]) ?>

            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'readonly' => $isUpdated]) ?>

            <?= $form->field($model, 'Auth_key')->hiddenInput(['maxlength' => true])->label(false) ?>

            <?= $form->field($model, 'Status')->dropDownList([
                '1' => 'Activo',
                '0' => 'No Activo',
            ]) ?>

            <?= $form->field($model, 'Tipo')->dropDownList($rolesList) ?>
            
            <?= $form->field($model, 'Created_at')->textInput(['readonly' => $isUpdated]) ?>

            <?= $form->field($model, 'Updated_at')->textInput(['readonly' => $isUpdated]) ?>

            <div class="form-group">
                <?= Html::submitButton('<span class="icon text-white-100"><i class="fas fa-check"></i></span><span class="text">Guardar</span>', ['class' => 'btn btn-success btn-icon-split']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>