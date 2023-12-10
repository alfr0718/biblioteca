<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Estanteriapersonal $model */

$this->title = 'Create Estanteriapersonal';
$this->params['breadcrumbs'][] = ['label' => 'Estanteriapersonals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estanteriapersonal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
