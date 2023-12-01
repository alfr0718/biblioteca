<?php

namespace app\controllers;

use app\models\Datospersonales;
use app\models\DatospersonalesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;

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

        if ($model->load(Yii::$app->request->post())) {
            $model->photofile = UploadedFile::getInstance($model, 'photofile');

            // Validar los archivos antes de intentar guardarlos
            if ($model->validate()) {
                
                // Guardar la imagen
                if ($model->photofile) {
                    $nombreImg = $model->Ci . '.' . $model->photofile->extension;
                    $model->Foto = $nombreImg;
                    $model->photofile->saveAs(Yii::getAlias('@webroot/uploads/img/') . $nombreImg);

                }
                // Guardar el resto de los atributos en la base de datos
                if ($model->save(false)) {
                    // Redirigir a la página de detalles o a donde desees
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
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

        if ($model->load(Yii::$app->request->post())) {
            $model->photofile = UploadedFile::getInstance($model, 'photofile');

            // Validar los archivos antes de intentar guardarlos
            if ($model->validate()) {

                // Guardar la imagen
                if ($model->photofile) {
                    $nombreImg = $model->Ci . '.' . $model->photofile->extension;
                    $model->Foto = $nombreImg;
                    $model->photofile->saveAs(Yii::getAlias('@webroot/uploads/img/') . $nombreImg);
                }
                // Guardar el resto de los atributos en la base de datos
                if ($model->save(false)) {
                    // Redirigir a la página de detalles o a donde desees
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
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

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
