<?php

namespace app\controllers;

use app\models\Acceptance;
use app\models\AcceptanceClass;
use app\models\ClassGroup;
use app\models\ClassSearch;
use app\models\CreateClassGroup;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClassController implements the CRUD actions for ClassGroup model.
 */
class ClassController extends Controller
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
     * Lists all ClassGroup models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ClassSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ClassGroup model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $dataProvider = new SqlDataProvider([
//            'query' => AcceptanceClass::find()->where(['class_id' => $id])->leftJoin('acceptance', 'acceptance.id = acceptance_class.class_id'),
//            'query' => ClassGroup::findBySql("SELECT class_group.name,acceptance.year FROM `class_group` JOIN acceptance_class on class_group.id = acceptance_class.class_id JOIN acceptance on acceptance_class.acceptance_id = acceptance.id WHERE class_group.id = 4;"),
            'sql' => 'SELECT class_group.name,acceptance.year FROM `class_group` JOIN acceptance_class on class_group.id = acceptance_class.class_id JOIN acceptance on acceptance_class.acceptance_id = acceptance.id WHERE class_group.id = 4'
        ]);


        return $this->render('view', [
            'model' => $model,
            'acceptance' => $dataProvider,
        ]);
    }

    /**
     * Creates a new ClassGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $acceptance = Acceptance::find()->asArray()->all();
        $acceptance = ArrayHelper::map($acceptance, 'id', 'year');
        $model = new CreateClassGroup();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'acceptance' => $acceptance,
        ]);
    }

    /**
     * Updates an existing ClassGroup model.
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
     * Deletes an existing ClassGroup model.
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
     * Finds the ClassGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ClassGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ClassGroup::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
