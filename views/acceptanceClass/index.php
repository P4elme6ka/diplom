<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AcceptanceClassSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Специальности';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acceptance-class-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать направление приема', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model['name'] . ' - ' . $model['year']), ['view', 'id' => $model['id']]);
        },
    ]) ?>


</div>
