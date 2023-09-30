<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Computador $model */

$this->title = $model->id_pc;
$this->params['breadcrumbs'][] = ['label' => 'Computadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="computador-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_pc' => $model->id_pc], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_pc' => $model->id_pc], [
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
            'id_pc',
            'pc_nombre',
            'pc_estado',
        ],
    ]) ?>

</div>
