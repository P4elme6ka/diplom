<?php

namespace app\controllers;

use app\models\UserAcceptanceRequest;
use app\models\UserAcceptanceRequestSearch;
use Yii;
use yii\data\SqlDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UseracceptancerequestController implements the CRUD actions for UserAcceptanceRequest model.
 */
class UseracceptancerequestController extends Controller
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
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        // other custom code here

        return true; // or false to not run the action
    }


    public function actionUserindex()
    {
        $dataProvider = new SqlDataProvider([
            'sql' => 'SELECT date,atestat_mean,acceptance_class_id,name,description FROM `user_acceptance_request` JOIN acceptance_class on user_acceptance_request.acceptance_class_id = acceptance_class.id WHERE user_id = ' . Yii::$app->user->identity->id,
        ]);

        return $this->render('userindex', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all UserAcceptanceRequest models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->identity->role->name != "admin") {
            Yii::$app->getSession()->setFlash('error', "Данному типу пользователя запрещен просмотр данного раздела");
            $this->redirect(['site/index']);
            return false;
        }

        $searchModel = new UserAcceptanceRequestSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $usersProvider = new SqlDataProvider([
           'sql' => 'SELECT user_acceptance_request.id,user.fio,user_acceptance_request.date,user.phone,user.email,acceptance_class.name,acceptance_class.description FROM `user_acceptance_request` JOIN user ON user_acceptance_request.user_id = user.id JOIN acceptance_class ON user_acceptance_request.acceptance_class_id = acceptance_class.id'
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'userProvider' => $usersProvider,
        ]);
    }

    /**
     * Lists all UserAcceptanceRequest models.
     *
     * @return string
     */
    public function actionSetoriginal($id)
    {
        if (Yii::$app->user->identity->role->name != "admin") {
            Yii::$app->getSession()->setFlash('error', "Данному типу пользователя запрещен просмотр данного раздела");
            $this->redirect(['site/index']);
            return false;
        }

        $model = UserAcceptanceRequest::findOne(['id' => $id]);

        $model->is_original = 1;

        $model->save();

        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Displays a single UserAcceptanceRequest model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $attachmentProvider = new SqlDataProvider([
            'sql' => '',
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserAcceptanceRequest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (Yii::$app->user->identity->role->name != "admin") {
            $this->redirect(['site/index']);
            return false;
        }

        $model = new UserAcceptanceRequest();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserAcceptanceRequest model.
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
     * Finds the UserAcceptanceRequest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return UserAcceptanceRequest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserAcceptanceRequest::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
