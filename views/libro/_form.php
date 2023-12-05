<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Libro $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="libro-form">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1 class="m-0 font-weight-bold text-primary"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'Titulo')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'Autor')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'Editorial')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'Anio')->textInput() ?>

            <?= $form->field($model, 'Isbn')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'N_clasificacion')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'Descripcion')->textarea(['rows' => 3]) ?>

            <?= $form->field($model, 'Status')->dropDownList([
                '1' => 'Disponible',
                '0' => 'No Disponible',
            ]) ?>

            <?= $form->field($model, 'idcategoria')->dropDownList(
                yii\helpers\ArrayHelper::map(\app\models\Categoria::find()->all(), 'id', 'Nombre'),
                ['prompt' => 'Selecciona categoria']
            ) ?>

            <?= $form->field($model, 'idpais')->dropDownList(
                yii\helpers\ArrayHelper::map(\app\models\Pais::find()->all(), 'id', 'Nombre'),
                ['prompt' => 'Selecciona un país']
            ) ?>

            <?= $form->field($model, 'idasignatura')->dropDownList(
                yii\helpers\ArrayHelper::map(\app\models\Asignatura::find()->all(), 'id', 'Nombre'),
                ['prompt' => 'Selecciona asignatura']
            ) ?>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'portadaFile')->fileInput(['class' => 'form-control', 'id' => 'portadaFileInput']) ?>
                    <img id="portadaPreview" src="#" alt="Vista previa" style="display: none; max-width: 100%; margin-top: 10px;">
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'docFile')->fileInput(['class' => 'form-control', 'id' => 'docFileInput']) ?>
                    <div id="docPreview" style="display: none; margin-top: 10px;"></div>
                </div>
            </div>
            
            <div class="form-group">
                <?= Html::submitButton('<i class="fas fa-check"></i>', ['class' => 'btn btn-success btn-circle']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>



    <?php // $form->field($model, 'portada')->textInput() 
    ?>

    <?php // $form->field($model, 'doc')->textInput() 
    ?>



</div>

    <?php $this->registerJs("
    function readURL(input, previewId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                if (previewId === '#portadaPreview') {
                    $(previewId).attr('src', e.target.result);
                } else {
                    $(previewId).text(input.files[0].name); // Muestra el nombre del archivo para documentos
                }
                
                $(previewId).show();
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#portadaFileInput').change(function () {
        readURL(this, '#portadaPreview');
    });

    $('#docFileInput').change(function () {
        readURL(this, '#docPreview');
    });
"); ?>