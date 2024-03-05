<?php

namespace app\controllers;

use app\models\Datospersonales;
use app\models\DatospersonalesSearch;
use app\models\Personacarrera;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;
use yii\web\ForbiddenHttpException;

/**
 * DatospersonalesController implements the CRUD actions for Datospersonales model.
 */
class DatospersonalesController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Datospersonales models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DatospersonalesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Datospersonales model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $user = Yii::$app->user->identity;

        if (!Yii::$app->user->can('admin') && $user->username !== $model->Ci) {
            throw new ForbiddenHttpException('No tienes permiso para acceder a esta página.');
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Datospersonales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Datospersonales();
        $selectedCarrera = [];

        $isUpdated = false;

        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                $model->photofile = UploadedFile::getInstance($model, 'photofile');

                // Validar los archivos antes de intentar guardarlos
                if ($model->validate()) {

                    // Guardar la imagen
                    if ($model->photofile) {
                        $nombreImg = $model->Ci . '.' . $model->photofile->extension;
                        $model->Foto = $nombreImg;
                    }
                    // Guardar el resto de los atributos en la base de datos
                    if ($model->save()) {

                        // Guardar la imagen
                        if ($model->photofile) {
                            $model->photofile->saveAs(Yii::getAlias('@webroot/uploads/img/') . $nombreImg);
                        }
                        // Redirigir a la página de detalles o a donde desees

                        if (!empty(\Yii::$app->request->post('Datospersonales')['personacarreras'])) {
                            foreach (\Yii::$app->request->post('Datospersonales')['personacarreras'] as $carreraId) {
                                $CarreraCursada = new Personacarrera();
                                $CarreraCursada->datospersonales_id = $model->id;
                                $CarreraCursada->carrera_idfac = $carreraId;
                                $CarreraCursada->save();
                            }
                        }

                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'isUpdated' => $isUpdated,
            'selectedCarrera' =>  $selectedCarrera,
        ]);
    }


    /**
     * Updates an existing Datospersonales model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $user = Yii::$app->user->identity;

        if (!Yii::$app->user->can('admin') && $user->username !== $model->Ci) {
            throw new ForbiddenHttpException('No tienes permiso para acceder a esta página.');
        }

        if (Yii::$app->user->can('admin') && $user->username !== $model->Ci) {
            $isUpdated = false;
        } else {
            $isUpdated = true;
        }

        $selectedCarrera = $model->getPersonacarreras()->select('carrera_idfac')->column();
        
        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                $model->photofile = UploadedFile::getInstance($model, 'photofile');

                // Validar los archivos antes de intentar guardarlos
                if ($model->validate()) {

                    // Guardar la imagen
                    if ($model->photofile) {
                        $nombreImg = $model->Ci . '.' . $model->photofile->extension;
                        $model->Foto = $nombreImg;
                    }
                    // Guardar el resto de los carreras en la base de datos
                    if ($model->save()) {

                        if ($model->photofile) {
                            $model->photofile->saveAs(Yii::getAlias('@webroot/uploads/img/') . $nombreImg);
                        }

                        if (Yii::$app->user->can('admin')) {
                            $existingCarrera = $model->getPersonacarreras()->select('carrera_idfac')->column();
                            $newCarrera = \Yii::$app->request->post('Datospersonales')['personacarreras'];

                            // Eliminar las carreras que no están en el formulario
                            $deletedCarrera = array_diff($existingCarrera, $newCarrera);
                            if (!empty($deletedCarrera)) {
                                foreach ($deletedCarrera as $carreraId) {
                                    Personacarrera::deleteAll(['datospersonales_id' => $model->id, 'carrera_idfac' => $carreraId]);
                                }
                            }

                            // Crear nuevas relaciones con las carreras seleccionadas
                            $addedCarrera = array_diff($newCarrera, $existingCarrera);
                            if (!empty($addedCarrera)) {
                                foreach ($addedCarrera as $carreraId) {
                                    $CarreraCursada = new Personacarrera();
                                    $CarreraCursada->datospersonales_id = $model->id;
                                    $CarreraCursada->carrera_idfac = $carreraId;
                                    $CarreraCursada->save();
                                }
                            }
                        }
                        // Redirigir a la página de detalles o a donde desees
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'isUpdated' => $isUpdated,
            'selectedCarrera' => $selectedCarrera, // Pasar las carreras seleccionadas a la vista
        ]);
    }


    /**
     * Deletes an existing Datospersonales model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Datospersonales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Datospersonales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Datospersonales::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('No se encontró esta página.');
    }
}
