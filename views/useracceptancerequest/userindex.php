<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\SqlDataProvider */

$this->title = 'Поданые заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acceptance-class-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return '  <div class="card">
                          <h5 class="card-header">' . $model["name"] . '</h5>
                          <div class="card-body">
                            <h5 class="card-title">Заявка от ' . $model["date"] . '</h5>
                            <p class="card-text">' . $model["description"] . '</p>
                            <a href="' . Url::toRoute(["useracceptancerequest/view", "id" => $model["id"]]) . '" class="btn btn-primary">Перейти к редактированию заявки</a>
                          </div>
                    </div>';
            // Html::a(Html::encode($model['name']));
        },
    ]) ?>
<!-- user_acceptance_request.id,user.fio,user_acceptance_request.date,user.phone,user.email,acceptance_class.name -->

</div>
