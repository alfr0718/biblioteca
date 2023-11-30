<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception$exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6 text-center">
                <div class="error mx-auto" data-text="Error"><h1><?= Html::encode($this->title) ?></h1></div>
                <p class="lead text-gray-800 mb-5"><?= nl2br(Html::encode($message)) ?></p>
                <p class="text-gray-500 mb-0">No eres tú, somos nosotros</p>
                <a href="/site/index">&larr; Regresar</a>
            </div>
        </div>
    </div>
</div>
