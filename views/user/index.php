<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'phone',
            'email',
            'age',
            'fio',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ]
//        'itemOptions' => ['class' => 'item'],
//        'itemView' => function ($model, $key, $index, $widget) {
//            return Html::a(Html::encode($model->fio . " " . $model->email . " " . $model->phone), ['view', 'id' => $model->id]);
//        },
    ]) ?>


</div>
