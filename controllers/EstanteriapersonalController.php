<?php

namespace app\controllers;

use app\models\Estanteria;
use app\models\Estanteriapersonal;
use app\models\EstanteriapersonalSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;

/**
 * EstanteriapersonalController implements the CRUD actions for Estanteriapersonal model.
 */
class EstanteriapersonalController extends Controller
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
     * Lists all Estanteriapersonal models.
     *
     * @return string
     */
    public function actionFavoritos($id)
    {
        $user = Yii::$app->user->identity;

        $misFavoritos = Estanteria::find()->where(['user_id' => $id])->one();

        if ($misFavoritos === null) {
            $misFavoritos = new Estanteria();
            $misFavoritos->Nombre = 'Mis Favoritos';
            $misFavoritos->user_id = $id;
            $misFavoritos->save();
        }

        $idEstanteria = $misFavoritos->id;

        $searchModel = new EstanteriapersonalSearch();
        // Filtra por Favoritos_id
        $searchModel->estanteria_id =  $idEstanteria;

        $dataProvider = $searchModel->search($this->request->queryParams);
        if ($user->id == $id) {
            return $this->render('favoritos', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            throw new ForbiddenHttpException('No tienes permiso para acceder a esta página.');
        }
    }


    public function actionAgregarFavoritos($id, $libro_id)
    {
        $misFavoritos = Estanteria::find()->where(['user_id' => $id])->one();

        if ($misFavoritos === null) {
            $misFavoritos = new Estanteria();
            $misFavoritos->Nombre = 'Mis Favoritos';
            $misFavoritos->user_id = $id;
            $misFavoritos->save();
        }

        $idEstanteria = $misFavoritos->id;

        // Verificar si ya existe un registro con el mismo libro_id y estanteria_id
        $existingRecord = Estanteriapersonal::findOne(['estanteria_id' => $idEstanteria, 'libro_id' => $libro_id]);

        if ($existingRecord === null) {
            $model = new Estanteriapersonal();
            $model->estanteria_id = $idEstanteria;
            $model->libro_id = $libro_id;
            $model->save();

            \Yii::$app->session->setFlash('success', 'Libro agregado a tus favoritos exitosamente.');
        } else {
            // Ya existe un registro, puedes manejar esto según tus necesidades.
            // Por ejemplo, podrías lanzar una excepción, mostrar un mensaje de error, etc.
            \Yii::$app->session->setFlash('error', 'Este libro ya está en tus favoritos.');
        }

        // Redirige a la misma página
        return $this->redirect(\Yii::$app->request->referrer ?: \Yii::$app->homeUrl);
    }
    public function actionEliminarFavorito($estanteria_id, $libro_id)
    {
        try {
            $model = $this->findModel($estanteria_id, $libro_id);
            $model->delete();
            $user_id = Estanteria::findOne($estanteria_id)->user_id;
            return $this->redirect(['favoritos', 'id' => $user_id]);
        } catch (\Exception $e) {
            Yii::error($e->getMessage());
            // Handle the error, e.g., show an error page or redirect to a specific page
        }
    }

    public function actionIndex()
    {
        $searchModel = new EstanteriapersonalSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Estanteriapersonal model.
     * @param int $estanteria_id Estanteria ID
     * @param int $libro_id Libro ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($estanteria_id, $libro_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($estanteria_id, $libro_id),
        ]);
    }

    /**
     * Creates a new Estanteriapersonal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Estanteriapersonal();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'estanteria_id' => $model->estanteria_id, 'libro_id' => $model->libro_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Estanteriapersonal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $estanteria_id Estanteria ID
     * @param int $libro_id Libro ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($estanteria_id, $libro_id)
    {
        $model = $this->findModel($estanteria_id, $libro_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'estanteria_id' => $model->estanteria_id, 'libro_id' => $model->libro_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Estanteriapersonal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $estanteria_id Estanteria ID
     * @param int $libro_id Libro ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($estanteria_id, $libro_id)
    {
        $this->findModel($estanteria_id, $libro_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Estanteriapersonal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $estanteria_id Estanteria ID
     * @param int $libro_id Libro ID
     * @return Estanteriapersonal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($estanteria_id, $libro_id)
    {
        if (($model = Estanteriapersonal::findOne(['estanteria_id' => $estanteria_id, 'libro_id' => $libro_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
