<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Acceptance */

$this->title = 'Обновление приема: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Прием', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->year, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="acceptance-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
