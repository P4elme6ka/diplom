<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AcceptanceClass */

$this->title = 'Create Acceptance Class';
$this->params['breadcrumbs'][] = ['label' => 'Acceptance Classes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acceptance-class-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
