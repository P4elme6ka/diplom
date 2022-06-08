<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Acceptance */

$this->title = 'Создание приема';
$this->params['breadcrumbs'][] = ['label' => 'Прием', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acceptance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
