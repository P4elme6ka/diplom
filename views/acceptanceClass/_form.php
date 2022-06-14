<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $items array */
/* @var $model app\models\AcceptanceClass */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acceptance-class-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'acceptance_id')->dropDownList($items) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'number_seats')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
