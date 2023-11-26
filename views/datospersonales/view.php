<?php

use app\models\Datospersonales;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Datospersonales $model */

$this->title =  $model->ApellidoPaterno . '' . $model->ApellidoMaterno . ' ' . $model->Nombres;

$this->params['breadcrumbs'][] = ['label' => 'Datospersonales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="datospersonales-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
        $user = Yii::$app->user->isGuest ? null : Yii::$app->user->identity;
        if ($user !== null && $user->Tipo === 88) {
            echo Html::a('Eliminar', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => '¿Estas seguro de Eliminar este elemento?',
                    'method' => 'post',
                ],
            ]);
        }
        ?>
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
    $user = Yii::$app->user->isGuest ? null : Yii::$app->user->identity;

    // Verificar si el usuario está autenticado y si el nombre de usuario coincide
    if ($user !== null && $user->username === $model->Ci) {
        echo Html::a('Cambiar Contraseña', ['user/change-password'], ['class' => 'btn btn-warning', 'confirm' => '¿Estás seguro de cambiar tu contraseña?']);
    }
    ?>

</div>