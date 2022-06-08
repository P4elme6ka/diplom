<?php

namespace app\controllers;

use app\models\AcceptanceClass;
use app\models\AcceptanceCreateForm;
use app\models\ClassGroup;
use Yii;
use yii\bootstrap4\ActiveForm;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\RegistrationForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
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
        $current_acceptance_provider = new SqlDataProvider([
            'sql' => 'SELECT name,description,
                            acceptance_class.id,
                            (SELECT date from user_acceptance_request 
                                WHERE user_acceptance_request.acceptance_class_id = acceptance_class.id
                                ORDER BY date DESC
                                LIMIT 1) as time FROM `acceptance_class`
                        JOIN acceptance ON acceptance_class.acceptance_id = acceptance.id
                        where acceptance.year = 
                        (
                            SELECT year from acceptance 
                            WHERE acceptance.is_open = 1 
                            ORDER BY acceptance.year DESC
                            LIMIT 1
                        )' // Все группы последнего открытого приема докуметов
        ]);

        return $this->render('index', [
            'current_acceptance_provider' => $current_acceptance_provider,
        ]);
    }

    public function actionCreateacc(){
        $group = AcceptanceClass::find()->asArray()->all();
        $group = ArrayHelper::map($group, 'id', 'name');
        $model = new AcceptanceCreateForm();

        if ($model->load(Yii::$app->request->post())) {

            $model->user_id = Yii::$app->user->identity->id;

            if ($model->save()) {
                return $this->redirect(['acceptanceclass/view', 'id' => $model->acceptance_class_id]);
            }
        }

        return $this->render('createacc', [
            'model' => $model,
            'classes' => $group,
        ]);
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
            return $this->goBack();
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
    public function actionRegister()
    {
        $model = new RegistrationForm();

        if ($model->load(Yii::$app->request->post()) ) {
            if (!$model->validate()) {
                Yii::$app->session->setFlash('fix the form');
//                VarDumper::dump($model);die;
                return $this->render('register', [
                    'model' => $model,
                ]);
            }
            if (!$model->save()) {
                Yii::$app->session->setFlash('some error on saving new user');
//                VarDumper::dump($model);die;
                return $this->render('register', [
                    'model' => $model,
                ]);
            }
            Yii::$app->session->setFlash('successfully registered');
            return $this->actionIndex();
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }
}
