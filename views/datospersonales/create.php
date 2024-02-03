<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Datospersonales $model */

$this->title = 'Registrar Datos Personales';
$this->params['breadcrumbs'][] = ['label' => 'Datospersonales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="datospersonales-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
        'isUpdated' => $isUpdated,
        'selectedCarrera' =>  $selectedCarrera,
 
    ]) ?>

</div>
