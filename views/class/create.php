<?php

use yii\helpers\Html;
use app\models\CreateClassGroup;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CreateClassGroup */
/* @var $acceptance array */

$this->title = 'Создание группы';
$this->params['breadcrumbs'][] = ['label' => 'Спсиок групп', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput()->label("Название группы") ?>

    <?= $form->field($model, 'yearAcceptanceId')->dropDownList($acceptance)->label("Год поступления") ?>

    <?= $form->field($model, 'noDocumentsAcceptance')->checkbox()->label("Открыть группу для поступления") ?>

    <?= $form->field($model, 'documentStartTime')->label("Начало приема документов") ?>

    <?= $form->field($model, 'documentStopTime')->label("Конец приема документов") ?>

    <div class="form-group">
        <?= Html::submitButton('Создать группу', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
