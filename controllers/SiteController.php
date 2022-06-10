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
use yii\web\UploadedFile;

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
        $group = AcceptanceClass::findBySql("SELECT * FROM `acceptance_class` JOIN acceptance on acceptance_class.acceptance_id = acceptance.id WHERE acceptance.is_open = 1")->asArray()->all();
        $group = ArrayHelper::map($group, 'id', 'name');
        $model = new AcceptanceCreateForm();

        if ($model->load(Yii::$app->request->post())) {

            $model->user_id = Yii::$app->user->identity->id;

            $model->accept_attach = UploadedFile::getInstance($model, 'accept_attach');
            $model->req_attach = UploadedFile::getInstance($model, 'req_attach');
            $model->atetat_attach = UploadedFile::getInstance($model, 'atetat_attach');


            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', "Заявка успешно создана");
                return $this->redirect(['acceptanceclass/view', 'id' => $model->acceptance_class_id]);
            } else {
                Yii::$app->getSession()->setFlash('error', "Неопределенная ошибка");
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
            Yii::$app->getSession()->setFlash('error', "Неверная почта или пароль");
            return $this->redirect(['index']);
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
                Yii::$app->session->setFlash('error', 'Ошибка в заполнении формы');
//                VarDumper::dump($model);die;
                return $this->render('register', [
                    'model' => $model,
                ]);
            }
            if (!$model->save()) {
                Yii::$app->session->setFlash('error', 'Произошла неизвестная ошибка');
//                VarDumper::dump($model);die;
                return $this->render('register', [
                    'model' => $model,
                ]);
            }
            Yii::$app->session->setFlash('success', 'Пользователь успешно зарегистрирован');
            return $this->actionIndex();
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }
}
