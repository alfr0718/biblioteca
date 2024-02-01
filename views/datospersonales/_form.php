<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Datospersonales $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="datospersonales-form">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-center">
            <h1 class="m-0 font-weight-bold text-primary"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>

            <div class="col-md-6">
                <?= $form->field($model, 'photofile')->label('Foto de Perfil')->fileInput(['class' => 'form-control', 'id' => 'photoFileInput']) ?>
                <img id="photoPreview" src="#" alt="Vista previa" style="display: none; max-width: 100%; margin-top: 10px;">
            </div>
            <?= $form->field($model, 'Ci')->textInput(['maxlength' => true, 'readonly' => $isUpdated]) ?>

            <?= $form->field($model, 'ApellidoPaterno')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'ApellidoMaterno')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'Nombres')->textInput(['maxlength' => true]) ?>


            <?= $form->field($model, 'Email')->textInput(['maxlength' => true]) ?>

            <?php echo $form->field($model, 'Status')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton('<span class="icon text-white-100"><i class="fas fa-check"></i></span><span class="text">Guardar</span>', ['class' => 'btn btn-success btn-icon-split']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


<?php $this->registerJs("
    function readURL(input, previewId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(previewId).attr('src', e.target.result);
                $(previewId).show();
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#photoFileInput').change(function () {
        readURL(this, '#photoPreview');
});
"); ?>