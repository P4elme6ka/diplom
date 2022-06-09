<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AcceptanceClass */

$this->title = 'Обновить специальность: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Список специальностей'];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="acceptance-class-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
