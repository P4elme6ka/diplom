<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserAcceptanceRequest */

$this->title = 'Обновление заявки абитуриента на обучение: ' . $model->user->fio;
$this->params['breadcrumbs'][] = ['label' => 'Заявки абитуриентов на обучение', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-acceptance-request-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
