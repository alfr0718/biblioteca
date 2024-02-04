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

    <div class="row">
        <!-- Primer card a la izquierda -->
        <div class="col-md-6">

            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <div class="card-header py-3 text-center">
                    <div class="d-flex align-items-center justify-content-center">
                        <div>
                            <h1 class="m-0 font-weight-bold text-primary">
                                <?= Html::encode($this->title) ?>
                            </h1>
                        </div>
                    </div>
                </div>



                <!-- Card Content - Collapse -->
                <div class="card-body">


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
                    <p>
                        <?= Html::a('<span class="icon text-white-100"><i class="fas fa-edit"></i></span><span class="text">Actualizar Carrera</span>', ['update', 'idcar' => $model->idcar], ['class' => 'btn btn-primary btn-icon-split']) ?>
                        <?= Html::a('<span class="icon text-white-100"><i class="fas fa-trash"></i></span><span class="text">Eliminar Carrera</span>', ['delete', 'idcar' => $model->idcar], [
                            'class' => 'btn btn-danger btn-icon-split',
                            'data' => [
                                'confirm' => '¿Estas seguro de Eliminar este elemento?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </p>
                </div>

            </div>
        </div>

        <!-- Segundo card a la derecha -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <div class="card-header py-3 text-center">
                    <div class="d-flex align-items-center justify-content-center">
                        <div>
                            <h3 class="text-primary">
                                <?php echo 'Asignaturas'; ?>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p>
                        <?= Html::a('<span class="icon text-white-100"><i class="fas fa-plus-circle"></i></span><span class="text">Añadir Asignatura</span>', ['agregar-asignatura-carrera', 'idcar' => $model->idcar], ['class' => 'btn btn-success btn-icon-split']) ?>
                    </p>
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
                                        [
                                            'format' => 'raw',
                                            'label' => '',
                                            'value' => Html::a('<i class="fa fa-edit"></i>', ['asignatura/update', 'id' => $Asignatura->id], ['class' => 'btn btn-primary btn-circle']) .
                                            Html::a('<i class="fa fa-trash"></i>', ['asignatura/delete', 'id' => $Asignatura->id], [
                                                'class' => 'btn btn-danger btn-circle',
                                                'data' => [
                                                    'confirm' => '¿Estás seguro de que quieres eliminar esta asignatura?',
                                                    'method' => 'post',
                                                ],
                                            ]),
                                        ],
                                    ],
                                ]); ?>
                            </div>

                        </div>
                    <?php $contador++;
                    endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>