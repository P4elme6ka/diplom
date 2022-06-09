<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserAcceptanceRequestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-acceptance-request-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'is_original') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'atestat_mean') ?>

    <?php // echo $form->field($model, 'acceptance_class_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
