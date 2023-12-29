<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <?= date('H:i - M d, Y ') ?>
            | Visitas Hoy:
            <?php

            use app\models\Transaccion;

            $contador = Transaccion::find()
                ->where(['action' => 'login', 'nombre_tabla' => 'user'])
                ->andWhere(['between', 'time', date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59')])
                ->count();
            echo $contador; ?>
        </div>
    </div>
</footer>