<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Estanteriapersonal $model */

$this->title = $model->estanteria_id;
$this->params['breadcrumbs'][] = ['label' => 'Estanteriapersonals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="estanteriapersonal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'estanteria_id' => $model->estanteria_id, 'libro_id' => $model->libro_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'estanteria_id' => $model->estanteria_id, 'libro_id' => $model->libro_id], [
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
            'estanteria_id',
            'libro_id',
        ],
    ]) ?>

</div>
