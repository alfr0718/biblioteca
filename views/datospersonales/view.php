<?php

use app\models\Datospersonales;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Datospersonales $model */

$this->title =  $model->ApellidoPaterno . ' ' . $model->ApellidoMaterno . ' ' . $model->Nombres;

$this->params['breadcrumbs'][] = ['label' => 'Datospersonales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="datospersonales-view">

    <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <div class="card-header py-3 text-center">
            <div class="d-flex align-items-center justify-content-center">
                <div class="mr-3" style="overflow: hidden; width: 150px; height: 150px; position: relative; border: 5px solid #fff; border-radius: 10px;">
                    <?php
                    $imagenUrl = Yii::getAlias('@webroot') . '/uploads/img/' . $model->Foto;

                    // Verificar si la imagen existe y $model->Foto no es nulo o vacío
                    if (!empty($model->Foto) && file_exists($imagenUrl)) {
                        // Si la imagen existe y $model->Foto no es nulo o vacío, mostrarla
                        echo Html::img(Yii::getAlias('@web') . '/uploads/img/' . $model->Foto, ['alt' => 'Foto de perfil', 'class' => 'img-thumbnail', 'style' => 'object-fit: cover; width: 100%; height: 100%; border-radius: 5px;']);
                    } else {
                        // Si la imagen no existe o $model->Foto es nulo o vacío, mostrar la imagen predeterminada
                        $imagenPredeterminadaUrl = Yii::getAlias('@web') . '/img/user-default.webp';
                        echo Html::img($imagenPredeterminadaUrl, ['alt' => 'Imagen predeterminada', 'class' => 'img-thumbnail', 'style' => 'object-fit: cover; width: 100%; height: 100%; border-radius: 5px;']);
                    }
                    ?>

                </div>
                <div>
                    <h3 class="m-0 font-weight-bold text-primary" style="font-size: 28px;">
                        <?= Html::encode($this->title) ?>
                    </h3>
                </div>
            </div>
        </div>



        <!-- Card Content - Collapse -->
        <div class="card-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    //'id',
                    'Ci',
                    'ApellidoPaterno',
                    'ApellidoMaterno',
                    'Nombres',
                    'Email:email',
                    // 'Status',
                ],
            ]) ?>
            <div class="mt-2">
                <?php
                if (!Yii::$app->user->isGuest && (Yii::$app->user->identity->username === $model-> Ci || Yii::$app->user->identity->Tipo === 88)) {
                    echo Html::a('<span class="icon text-white-100"><i class="fas fa-user-edit"></i></span><span class="text">Actualizar Datos</span>', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-icon-split']);
                } ?>
                <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->Tipo === 88) {
                    echo Html::a('<span class="icon text-white-100"><i class="fas fa-trash"></i></span><span class="text">Eliminar</span>', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger btn-icon-split',
                        'data' => [
                            'confirm' => '¿Estas seguro de Eliminar este elemento?',
                            'method' => 'post',
                        ],
                    ]);
                }
                ?>
                <?php
                $user = Yii::$app->user->isGuest ? null : Yii::$app->user->identity;

                // Verificar si el usuario está autenticado y si el nombre de usuario coincide
                if ($user !== null && $user->username === $model->Ci) {
                    echo Html::a('<span class="icon text-white-100"><i class="fas fa-lock"></i></span><span class="text">Cambiar Contraseña</span>', ['user/change-password'], ['class' => 'btn btn-warning btn-icon-split', 'confirm' => '¿Estás seguro de cambiar tu contraseña?']);
                }
                ?>
            </div>
        </div>
    </div>


</div>