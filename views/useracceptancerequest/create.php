<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserAcceptanceRequest */

$this->title = 'Create User Acceptance Request';
$this->params['breadcrumbs'][] = ['label' => 'User Acceptance Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-acceptance-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
