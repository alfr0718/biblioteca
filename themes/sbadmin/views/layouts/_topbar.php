<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->Tipo == 88) : ?>

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
    <?php endif; ?>

    <a class="navbar-brand" href="<?= Yii::$app->homeUrl ?>">
        <img src="<?= Yii::getAlias('@web') ?>/img/InstLuisTello.png" alt="Logo" height="45">
    </a>

    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="<?= \yii\helpers\Url::to(['libro/search']) ?>" method="get">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar por Título..." aria-label="Search" aria-describedby="basic-addon2" name="LibroSearch[Titulo]">
            <!-- Agrega el atributo name para asociar el campo de entrada con el modelo -->
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>


    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['libro/index']) ?>">
                <span class="mr-2 d-none d-lg-inline text-primary small"><strong>BIBLIOTECA</strong></span>
            </a>
        </li>

        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search" action="<?= \yii\helpers\Url::to(['libro/search']) ?>" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar por Título..." aria-label="Search" aria-describedby="basic-addon2" name="LibroSearch[Titulo]">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>



        <div class="topbar-divider d-none d-sm-block"></div>
        <?php if (Yii::$app->user->isGuest) : ?>


            <li class="nav-item dropdown no-arrow">
                <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['site/login']) ?>">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Iniciar Sesión </span>
                    <i class=" fas fa-sign-in-alt fa-fw"></i>
                </a>

            </li>


        <?php else : ?>

            <?php
            $user = Yii::$app->user->identity;
            $datos = $user->datospersonales;
            $nombres = $datos->ApellidoPaterno . ' ' . $datos->ApellidoMaterno . ' ' . $datos->Nombres;
            ?>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $nombres ?></span>
                    <?php
                    $imagenUrl = Yii::getAlias('@web') . '/uploads/img/' . $datos->Foto;

                    // Verificar si la imagen existe
                    if (file_exists($imagenUrl)) {
                        // Si la imagen existe, mostrarla
                        echo '<img class="img-profile rounded-circle" src="' . $imagenUrl . '" alt="Fotos de usuario">';
                    } else {
                        // Si la imagen no existe, mostrar la imagen predeterminada
                        $imagenPredeterminadaUrl = Yii::getAlias('@web') . '/img/user-default.webp';
                        echo '<img class="img-profile rounded-circle" src="' . $imagenPredeterminadaUrl . '" alt="User">';
                    }
                    ?>
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?= Yii::$app->urlManager->createUrl(['datospersonales/view', 'id' => $datos->id]) ?>">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Perfil
                        <a class="dropdown-item" href="<?= Yii::$app->urlManager->createUrl(['estanteriapersonal/favoritos', 'id' => $user->id]) ?>">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Mis favoritos
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Cerrar Sesión
                        </a>
                </div>
            <?php endif; ?>

            </li>

    </ul>

</nav>