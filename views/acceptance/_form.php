<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Acceptance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acceptance-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'year')->textInput()->label("Год приема") ?>

    <?= $form->field($model, 'is_open')->textInput()->label("Открыть для приема документов") ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
