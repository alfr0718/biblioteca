<?php

use app\models\Datospersonales;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Datospersonales $model */

    $datospersonales = Datospersonales::findByCedula(Yii::$app->user->identity->username);
    if ($datospersonales !== null) {
        $nombreCompleto = $datospersonales->getNombreCompleto();
        $this->title = $nombreCompleto;
    } else {
        $this->title= "No se encontró ninguna persona con la cédula proporcionada.";
    }

$this->params['breadcrumbs'][] = ['label' => 'Datospersonales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="datospersonales-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'Ci',
            'ApellidoMaterno',
            'ApellidoPaterno',
            'Nombres',
            'Email:email',
            // 'Status',
        ],
    ]) ?>

    <?php
    $user = Yii::$app->user->identity;
    if ($user->username === $model->Ci) {
        echo Html::a('Cambiar Contraseña', ['user/change-password'], ['class' => 'btn btn-warning'], ['confirm' => '¿Estas seguro de cambiar tu contraseña?',]);
    }
    ?>

</div>