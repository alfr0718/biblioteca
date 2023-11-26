<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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

</div>
