<?php

use miloschuman\highcharts\Highcharts;
use yii\helpers\Html;

$this->title = 'Gráficas';
?>

<div class="grafica-container">
    <div class="row">

        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?= Html::encode($this->title) ?></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form method="get" action="<?= Yii::$app->urlManager->createUrl(['site/stadistics']) ?>">
                        <div class="form-group">
                            <label for="month">Mes:</label>
                            <select name="month" id="month" class="form-control">
                                <?php
                                $monthNames = [
                                    1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio',
                                    7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre',
                                ];

                                foreach ($monthNames as $monthNumber => $monthName) : ?>
                                    <option value="<?= $monthNumber ?>" <?= ($selectedMonth == $monthNumber) ? 'selected' : '' ?>>
                                        <?= $monthName ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="year">Año:</label>
                            <select name="year" id="year" class="form-control">
                                <?php foreach ($Years as $distinctYear) : ?>
                                    <option value="<?= $distinctYear ?>" <?= ($selectedYear == $distinctYear) ? 'selected' : '' ?>>
                                        <?= $distinctYear ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Generar reporte</button>
                        <a href="<?= Yii::$app->urlManager->createUrl(['site/stadistics']) ?>" class="btn btn-secondary">Reiniciar</a>

                    </form>
                </div>
            </div>
        </div>



        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <?php
                        $selectedMonth = $selectedMonth ?? date('n');
                        $monthName = date('M', mktime(0, 0, 0, $selectedMonth, 1));
                        $selectedYear = $selectedYear ?? date('Y');
                        ?>

                        <?= $monthName ?>
                        <?= $selectedYear ?>
                    </h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <?php echo Highcharts::widget([
                        'options' => [
                            'title' => ['text' => 'Estadísticas Generales'],
                            'xAxis' => [
                                'categories' => array_column($data, 'dia'),
                                'title' => ['text' => 'Día del Mes'],
                            ],
                            'yAxis' => [
                                'title' => ['text' => 'Cantidad'],
                            ],
                            'plotOptions' => [
                                'line' => [
                                    'lineWidth' => 2,
                                    'shadow' => false,
                                ],
                                'spline' => [
                                    'lineWidth' => 2,
                                    'shadow' => false,
                                ],
                            ],
                            'series' => [
                                [
                                    'name' => 'Logins',
                                    'data' => array_column($data, 'total_logins'),
                                    'type' => 'area',
                                    'color' => '#3498db',
                                ],
                                [
                                    'name' => 'Búsqueda Bibliográfica',
                                    'data' => array_column($data, 'total_search'),
                                    'type' => 'area',
                                    'color' => '#2ecc71',
                                ],
                                [
                                    'name' => 'Acceso A Libros',
                                    'data' => array_column($data, 'total_request'),
                                    'type' => 'area',
                                    'color' => '#e67e22',
                                ],
                                [
                                    'name' => 'Visualizaciones',
                                    'data' => array_column($data, 'total_view'),
                                    'type' => 'area',
                                    'color' => '#9b59b6',
                                ],
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>