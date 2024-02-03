<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LibroSearch $model */
/** @var yii\widgets\ActiveForm $form */

$paisesConLibros = \app\models\Libro::find()->select('idpais')->distinct()->column();

$userId = Yii::$app->user->identity->datospersonales->id;

$carreraIds = \app\models\Personacarrera::find()
    ->select('carrera_idfac')
    ->where(['datospersonales_id' => $userId])
    ->column();

if (empty($carreraIds) || in_array(1, $carreraIds)) {
    $asignaturasConLibros = \app\models\Libro::find()
        ->select('idasignatura')
        ->distinct()
        ->column();
} else {
    $asignaturasConLibros = \app\models\Libro::find()
        ->joinWith('idasignatura0')
        ->where(['asignatura.idcar' => $carreraIds])
        ->select('idasignatura')
        ->distinct()
        ->column();
}

?>

<div class="libro-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get', 'options' => [
            'data-pjax' => 1
        ],

    ]); ?>

    <?php // $form->field($model, 'id') 
    ?>
    <div class="row">
        <div class="col">
            <div class="input-group">
                <?= $form->field($model, 'searchTerm', ['options' => ['class' => 'input-group', 'style' => 'flex: 1;']])
                    ->label(false)
                    ->textInput(['placeholder' => 'Buscar...', 'class' => 'form-control']) ?>

                <div class="input-group-append">
                    <?= Html::submitButton('<i class="fas fa-search"></i>', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="d-flex">
                <?= $form->field($model, 'searchField', ['options' => ['class' => 'form-group', 'style' => 'margin-right: 10px;']])
                    ->label(false)
                    ->dropDownList(
                        [
                            'Titulo' => 'Título',
                            'Autor' => 'Autor',
                            'Editorial' => 'Editorial',
                            'Isbn' => 'ISBN',
                        ],
                        [
                            'class' => 'btn btn-info text-left', // Añadido "text-left"
                        ]
                    ) ?>

                <?= Html::resetButton('<i class="fas fa-eraser"></i>', [
                    'class' => 'btn btn-outline-secondary btn-circle',
                    'id' => 'reset-btn',
                    'onclick' => 'window.location.href="' . \yii\helpers\Url::to(['libro/index']) . '"; return false;',
                ]) ?>
            </div>
        </div>


    </div>





    <?= $form->field($model, 'Titulo')->label(false)->hiddenInput() ?>

    <?= $form->field($model, 'Autor')->label(false)->hiddenInput() ?>

    <?= $form->field($model, 'Editorial')->label(false)->hiddenInput() ?>

    <?php echo $form->field($model, 'Isbn')->label(false)->hiddenInput() ?>

    <?php // echo $form->field($model, 'N_clasificacion') 
    ?>

    <?php // echo $form->field($model, 'Descripcion') 
    ?>

    <?php // echo $form->field($model, 'Status') 
    ?>

    <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#filtrosSearch" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse" id="filtrosSearch">
            <div class="card-body">
                <?= $form->field($model, 'Anio') ?>

                <?php echo $form->field($model, 'idcategoria')->dropDownList(
                    yii\helpers\ArrayHelper::map(\app\models\Categoria::find()->all(), 'id', 'Nombre'),
                    ['prompt' => 'Ver Todo']
                ) ?>

                <?php echo $form->field($model, 'idpais')->dropDownList(
                    yii\helpers\ArrayHelper::map(\app\models\Pais::find()->where(['id' => $paisesConLibros])->all(), 'id', 'Nombre'),
                    ['prompt' => 'Ver Todo']
                ) ?>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#asignaturasSearch" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-primary">Asignaturas</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse" id="asignaturasSearch">
            <div class="card-body">
                <?= $form->field($model, 'idasignatura')->label(false)->checkboxList(
                    yii\helpers\ArrayHelper::map(\app\models\Asignatura::find()->where(['id' => $asignaturasConLibros])->all(), 'id', 'Nombre'),
                    ['itemOptions' => ['labelOptions' => ['class' => 'checkbox-inline']], 'separator' => '<br>']
                ) ?>
            </div>
        </div>
    </div>



    <?php // echo $form->field($model, 'portada') 
    ?>

    <?php // echo $form->field($model, 'doc') 
    ?>

    <?php ActiveForm::end(); ?>

</div>