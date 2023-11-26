<?php

namespace app\controllers;

use app\models\Libro;
use app\models\LibroSearch;
use app\models\Transaccion;
use yii\web\UploadedFile;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;


/**
 * LibroController implements the CRUD actions for Libro model.
 */
class LibroController extends Controller
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
     * Lists all Libro models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new LibroSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Libro model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = Libro::findOne($id);

        if (!$model) {
            throw new NotFoundHttpException('El libro no se encontró.');
        }

        // Crea la instancia de Transaccion y configura los atributos
        $view = new Transaccion();
        $view->user_id = Yii::$app->user->isGuest ? 0 : Yii::$app->user->id;
        $view->action = 'view';
        $view->nombre_tabla = 'libro';
        $view->item_id = $id;
        $view->save();

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Libro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Libro();

        if ($model->load(Yii::$app->request->post())) {
            $model->portadaFile = UploadedFile::getInstance($model, 'portadaFile');
            $model->docFile = UploadedFile::getInstance($model, 'docFile');

            // Validar los archivos antes de intentar guardarlos
            if ($model->validate()) {
                
                // Guardar la imagen
                if ($model->portadaFile) {
                    $nombreImg = $model->portadaFile->baseName . '.' . $model->portadaFile->extension;
                    $model->portada = $nombreImg;
                    $model->portadaFile->saveAs(Yii::getAlias('@webroot/uploads/portada/') . $nombreImg);

                }

                // Guardar el documento
                if ($model->docFile) {
                    $nombreDoc = $model->docFile->baseName . '.' . $model->docFile->extension;
                    $model->doc = $nombreDoc;
                    $model->docFile->saveAs(Yii::getAlias('@webroot/uploads/doc/') . $nombreDoc);
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
     * Updates an existing Libro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->portadaFile = UploadedFile::getInstance($model, 'portadaFile');
            $model->docFile = UploadedFile::getInstance($model, 'docFile');

            // Validar los archivos antes de intentar guardarlos
            if ($model->validate()) {

                // Guardar la imagen
                if ($model->portadaFile) {
                    $nombreImg = $model->portadaFile->baseName . '.' . $model->portadaFile->extension;
                    $model->portada = $nombreImg;
                    $model->portadaFile->saveAs(Yii::getAlias('@webroot/uploads/portada/') . $nombreImg);
                }

                // Guardar el documento
                if ($model->docFile) {
                    $nombreDoc = $model->docFile->baseName . '.' . $model->docFile->extension;
                    $model->doc = $nombreDoc;
                    $model->docFile->saveAs(Yii::getAlias('@webroot/uploads/doc/') . $nombreDoc);
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
     * Deletes an existing Libro model.
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
     * Finds the Libro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Libro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Libro::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionRequest($id)
    {
        // Obtén el modelo de libro según el $id (ajusta esto según tu lógica)
        $model = Libro::findOne($id);

        if (!$model) {
            throw new NotFoundHttpException('El libro no se encontró.');
        }

        // Crea la instancia de Transaccion y configura los atributos
        $view = new Transaccion();
        $view->user_id = Yii::$app->user->isGuest ? 0 : Yii::$app->user->id;
        $view->action = 'request';
        $view->nombre_tabla = 'libro';
        $view->item_id = $id;
        $view->save();

        // Envía el documento al navegador
        return $this->asJson(['url' => Yii::getAlias('@web/uploads/doc/') . $model->doc]);
    }
}

