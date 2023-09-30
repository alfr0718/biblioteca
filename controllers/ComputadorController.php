<?php

namespace app\controllers;

use app\models\Computador;
use app\models\ComputadorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ComputadorController implements the CRUD actions for Computador model.
 */
class ComputadorController extends Controller
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
     * Lists all Computador models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ComputadorSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Computador model.
     * @param int $id_pc Id Pc
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_pc)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_pc),
        ]);
    }

    /**
     * Creates a new Computador model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Computador();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_pc' => $model->id_pc]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Computador model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_pc Id Pc
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_pc)
    {
        $model = $this->findModel($id_pc);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_pc' => $model->id_pc]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Computador model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_pc Id Pc
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_pc)
    {
        $this->findModel($id_pc)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Computador model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_pc Id Pc
     * @return Computador the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_pc)
    {
        if (($model = Computador::findOne(['id_pc' => $id_pc])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
