<?php

namespace app\controllers;

use app\models\UserAcceptanceRequest;
use app\models\UserAcceptanceRequestSearch;
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

    /**
     * Lists all UserAcceptanceRequest models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserAcceptanceRequestSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $usersProvider = new SqlDataProvider([
           'sql' => 'SELECT user_acceptance_request.id,user.fio,user_acceptance_request.date,user.phone,user.email FROM `user_acceptance_request` JOIN user ON user_acceptance_request.user_id = user.id'
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
        $model = UserAcceptanceRequest::findOne(['id' => $id]);

        $usersProvider = new SqlDataProvider([
            'sql' => 'SELECT user_acceptance_request.id,user.fio,user_acceptance_request.date,user.phone,user.email FROM `user_acceptance_request` JOIN user ON user_acceptance_request.user_id = user.id'
        ]);

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single UserAcceptanceRequest model.
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
     * Creates a new UserAcceptanceRequest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
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
     * Updates an existing UserAcceptanceRequest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
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
