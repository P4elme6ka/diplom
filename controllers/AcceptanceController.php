<?php

namespace app\controllers;

use app\models\Acceptance;
use app\models\AcceptanceSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AcceptanceController implements the CRUD actions for Acceptance model.
 */
class AcceptanceController extends Controller
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

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        if (Yii::$app->user->identity->role->name != "admin") {
            Yii::$app->getSession()->setFlash('error', "Данному типу пользователя запрещен просмотр данного раздела");
            $this->redirect(['index']);
            return false;
        }
        // other custom code here

        return true; // or false to not run the action
    }

    /**
     * Lists all Acceptance models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AcceptanceSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Acceptance model.
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
     * Creates a new Acceptance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Acceptance();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->getSession()->setFlash('success', "Прием успешно создан");
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Acceptance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', "Успешно изменино");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Acceptance model.
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

    public function actionOpen($id)
    {
        if ($this->countOpenedAcceptances() > 0) {
            Yii::$app->getSession()->setFlash('success', "Нельзя открыть для приема более одного приема");
            return $this->redirect(['index']);
        }

        $model = $this->findModel($id);
        $model->is_open = 1;
        $model->save();
        Yii::$app->getSession()->setFlash('success', "Прием успешно отрыт для получения заявок");
        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionClose($id)
    {
        $model = $this->findModel($id);
        $model->is_open = 0;
        $model->save();

        Yii::$app->getSession()->setFlash('error', "Прием успешно закрыт");
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Finds the Acceptance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Acceptance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Acceptance::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Такой страницы не существует');
    }

    protected function countOpenedAcceptances()
    {
        return Acceptance::find()->where("is_open = 1")->count();
    }
}
