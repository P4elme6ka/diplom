<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\helpers\VarDumper;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserAcceptanceRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $userProvider yii\data\SqlDataProvider */

$this->title = 'Заявки абитуриентов на обучение';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-acceptance-request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $userProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model['fio']), ['view', 'id' => $model['id']]);
        },
    ]) ?>


</div>
