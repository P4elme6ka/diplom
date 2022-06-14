<?php

namespace app\controllers;

use app\models\Acceptance;
use app\models\AcceptanceClass;
use app\models\AcceptanceClassSearch;
use Yii;
use yii\data\SqlDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AcceptanceClassController implements the CRUD actions for AcceptanceClass model.
 */
class AcceptanceclassController extends Controller
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

    /**
     * Displays a single AcceptanceClass model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $users_provider = new SqlDataProvider([
           'sql' => "SELECT user_acceptance_request.id,user_acceptance_request.is_original,user.fio,user_acceptance_request.atestat_mean FROM `user_acceptance_request` JOIN user ON user_acceptance_request.user_id = user.id WHERE user_acceptance_request.acceptance_class_id =" . $id . " ORDER BY user_acceptance_request.is_original DESC, user_acceptance_request.atestat_mean DESC"
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'users' => $users_provider,
        ]);
    }


    /**
     * Updates an existing AcceptanceClass model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->identity->role->name != "admin") {
            Yii::$app->getSession()->setFlash('error', "Данному типу пользователя запрещен просмотр данного раздела");
            $this->redirect(['site/index']);
            return false;
        }

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
     * Lists all AcceptanceClass models.
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

        $dataProvider = new SqlDataProvider([
            'sql' => "SELECT acceptance_class.name,acceptance_class.id,acceptance.year from acceptance_class JOIN acceptance ON acceptance_class.acceptance_id = acceptance.id",
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new AcceptanceClass model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (Yii::$app->user->identity->role->name != "admin") {
            $this->redirect(['site/index']);
            return false;
        }

        $items = Acceptance::find()->all();
        $items = ArrayHelper::map($items, 'id', 'year');

        $model = new AcceptanceClass();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'items' => $items,
        ]);
    }

    /**
     * Deletes an existing AcceptanceClass model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->identity->role->name != "admin") {
            Yii::$app->getSession()->setFlash('error', "Данному типу пользователя запрещен просмотр данного раздела");
            return $this->redirect(['site/index']);;
        }

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AcceptanceClass model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return AcceptanceClass the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AcceptanceClass::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
