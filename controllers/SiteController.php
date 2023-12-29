<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Libro;
use app\models\Transaccion;
use yii\db\Expression;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $librosRecientes = Transaccion::find()
        ->select('item_id')
        ->where(['action' => 'create', 'nombre_tabla' => 'libro'])
        ->orderBy(['time' => SORT_DESC])
        ->limit(10)
        ->column();

        $modelLibrosRecientes = Libro::find()
        ->where(['id' => $librosRecientes])
        ->all();

        $librosMasVistos = Transaccion::find()
        ->select('item_id, COUNT(item_id) as vistas')
        ->where(['action' => 'view', 'nombre_tabla' => 'libro'])
        ->groupBy('item_id')
        ->orderBy(['vistas' => SORT_DESC])
        ->limit(10)
        ->column();

        $modelLibrosMasVistos = Libro::find()
        ->where(['id' => $librosMasVistos])
        ->all();

        return $this->render('index', ['modelLibrosRecientes' => $modelLibrosRecientes, 'modelLibrosMasVistos' => $modelLibrosMasVistos]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (Yii::$app->user->identity->Tipo === 88) {
                return $this->redirect(['site/stadistics']);
            } else {
                return $this->goBack();
            }
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }



    public function actionStadistics($month = null, $year = null)
    {
        $this->view->title = 'Estadísticas';

        if ($month === null) {
            $month = date('m');
        }

        if ($year === null) {
            $year = date('Y');
        }
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        // Generate an array representing all days of the selected month
        $allDays = range(1, $daysInMonth);


        $actions = ['login', 'search', 'request', 'view'];
        $data = [];

        foreach ($actions as $action) {
            $query = Yii::$app->db->createCommand('
            SELECT DAY(time) AS dia, COUNT(*) AS total
            FROM transaccion
            WHERE nombre_tabla = "libro" AND action = :action
              AND MONTH(time) = :month
              AND YEAR(time) = :year
            GROUP BY DAY(time)
        ')->bindValues([':action' => $action, ':month' => $month, ':year' => $year])->queryAll();

            // Convert the query result into an associative array for easy merging
            $data[$action] = array_column($query, 'total', 'dia');
        }

        // Merge data with all days to ensure all days are present
        $mergedData = [];

        foreach ($allDays as $day) {
            $mergedData[] = [
                'dia' => $day,
                'total_logins' => $data['login'][$day] ?? 0,
                'total_search' => $data['search'][$day] ?? 0,
                'total_request' => $data['request'][$day] ?? 0,
                'total_view' => $data['view'][$day] ?? 0,
            ];
        }

        $Years = Yii::$app->db->createCommand('
        SELECT DISTINCT YEAR(time) AS year
        FROM transaccion
    ')->queryColumn();

        return $this->render('stadistics', [
            'data' => $mergedData,
            'selectedMonth' => $month,
            'selectedYear' => $year,
            'Years' => $Years,
            'selectMonth' => $month,
            'selectYear' => $year,
        ]);
    }
}
