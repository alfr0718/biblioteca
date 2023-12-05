<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

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
            'id',
            'username',
            //'password',
            //'Auth_key',
            [
                'attribute' => 'Status',
                'value' => function ($model) {
                    return $model->Status == 1 ? 'Activo' : 'Inactivo';
                },
            ],
            [
                'attribute' => 'Tipo',
                'value' => function ($model) {
                    switch ($model->Tipo) {
                        case 88:
                            return 'Admin';
                        case 66:
                            return 'Docente';
                        case 11:
                            return 'Estudiante';
                        default:
                            return 'Desconocido';
                    }
                },
            ],
            'Created_at',
            'Updated_at',
        ],
    ]) ?>
<div class="mt-2">
        <?php
                    echo Html::a('<span class="icon text-white-100"><i class="fas fa-user-edit"></i></span><span class="text">Actualizar</span>', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-icon-split']);
                    ?>
                    <?php 
                        echo Html::a('<span class="icon text-white-100"><i class="fas fa-trash"></i></span><span class="text">Eliminar</span>', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger btn-icon-split',
                            'data' => [
                                'confirm' => '¿Estas seguro de Eliminar este elemento?',
                                'method' => 'post',
                            ],
                        ]);
                    
                    ?>
                      </div>
      </div>
</div>
</div>
