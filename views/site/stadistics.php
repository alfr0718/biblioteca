<?php

use miloschuman\highcharts\Highcharts;

$this->title = 'Gráfica de Logins por Mes';
?>

<div class="grafica-container">

    <div class="grafica-container">
        <form method="get" action="<?= Yii::$app->urlManager->createUrl(['site/stadistics']) ?>">
            <div class="form-group">

                <label for="month">Mes:</label>
                <select name="month" id="month" class="form-control">
                    <?php for ($i = 1; $i <= 12; $i++) : ?>
                        <option value="<?= $i ?>" <?= ($selectedMonth == $i) ? 'selected' : '' ?>>
                            <?= date('M', strtotime("2022-$i-01")) ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="form-group">

                <label for="year">Año:</label>
                <select name="year" id="year" class="form-control">
                    <?php for ($i = date('Y'); $i >= 2020; $i--) : ?>
                        <option value="<?= $i ?>" <?= ($selectedYear == $i) ? 'selected' : '' ?>><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="<?= Yii::$app->urlManager->createUrl(['site/stadistics']) ?>" class="btn btn-secondary">Reiniciar</a>

        </form>

        <?php
        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => 'Estadísticas Generales'],
                'xAxis' => [
                    'categories' => array_column($login, 'dia'),
                    'title' => ['text' => 'Día del Mes'],
                ],
                'yAxis' => [
                    'title' => ['text' => 'Cantidad'],
                ],
                'plotOptions' => [
                    'line' => [
                        'lineWidth' => 2, // Ajusta el grosor de la línea
                        'shadow' => false, // Desactiva las sombras
                    ],
                    'spline' => [
                        'lineWidth' => 2, // Ajusta el grosor de la línea
                        'shadow' => false, // Desactiva las sombras
                    ],
                ],
                'series' => [
                    [
                        'name' => 'Logins',
                        'data' => array_column($login, 'total_logins'),
                        'type' => 'area',
                        'color' => '#3498db', 

                    ],
                    [
                        'name' => 'Búsqueda Bibliográfica',
                        'data' => array_column($search, 'total_search'),
                        'type' => 'area',
                        'color' => '#2ecc71', 

                    ],
                    [
                        'name' => 'Acceso A Libros',
                        'data' => array_column($request, 'total_request'),
                        'type' => 'area',
                        'color' => '#e67e22', // Color morado

                    ],
                    [
                        'name' => 'Visualizaciones',
                        'data' => array_column($view, 'total_view'),
                        'type' => 'area',
                        'color' => '#9b59b6', // Color morado

                    ],
                ],
            ],
        ]);
        ?>



    </div>