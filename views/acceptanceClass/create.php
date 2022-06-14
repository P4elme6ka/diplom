<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $items array */
/* @var $model app\models\AcceptanceClass */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Создать направление для поступления';
$this->params['breadcrumbs'][] = ['label' => 'Специальности', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acceptance-class-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="acceptance-class-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'acceptance_id')->dropDownList($items)->label('Год приема') ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Название') ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6])->label("Описание специальности") ?>

        <?= $form->field($model, 'number_seats')->textInput()->label('Количество мест для приема') ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
