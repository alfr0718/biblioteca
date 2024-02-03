<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Carrera $model */

$this->title = $model->Nombre;
$this->params['breadcrumbs'][] = ['label' => 'Carreras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="carrera-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'idcar' => $model->idcar], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'idcar' => $model->idcar], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estas seguro de Eliminar este elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idcar',
            'Nombre',
            [
                'attribute' => 'Status',
                'value' => function ($model) {
                    return $model->Status == 1 ? 'Activo' : 'Inactivo';
                },
            ],
        ],
    ]) ?>
    
    <?= Html::a('Agregar Asignatura', ['agregar-asignatura-carrera', 'idcar' => $model->idcar], ['class' => 'btn btn-primary']) ?>

    <?php $contador = 1;
    foreach ($AllAsignaturas as $Asignatura) : ?>
        <div class="row">
            <div class="col-md-6">
                <?= DetailView::widget([
                    'model' => $Asignatura,
                    'attributes' => [
                        [
                            'label' => $contador,
                            'value' => $Asignatura->Nombre,
                        ],
                        // Agrega más atributos según sea necesario
                    ],
                ]); ?>
            </div>
            <div class="col-md-6">
                <?= Html::a('Editar', ['asignatura/update', 'id' => $Asignatura->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Eliminar', ['asignatura/delete', 'id' => $Asignatura->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => '¿Estás seguro de que quieres eliminar esta asignatura?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>
    <?php
        $contador++;
    endforeach; ?>





</div>