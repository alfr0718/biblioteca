<?php if (Yii::$app->user->isGuest) : ?>

    <div class="container-fluid ">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col col-xl-10 col-lg-12 col-md-9">
                <?= $content ?>
            </div>
        </div>
    </div>

<?php else : ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="content-wrapper d-flex flex-column">

        <!-- Main Content -->
        <div id="content" class="content">

            <!-- Topbar -->
            <?= $this->render('_topbar') ?>
            <!-- End of Topbar -->

            <!-- JavaScript core de Bootstrap -->



            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <?= $content ?>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?= $this->render('_footer') ?>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->
<?php endif; ?>