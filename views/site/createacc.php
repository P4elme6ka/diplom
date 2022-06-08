<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */

/** @var app\models\AcceptanceCreateForm $model */
/** @var array $classes */


use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\jui\DatePicker;

$this->title = 'Подача заявки на обучение';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                'id' => 'contact-form'
            ]); ?>

            <?= $form->field($model, 'atestat_mean') ?>

            <?= $form->field($model, 'acceptance_class_id')->dropdownList($classes) ?>

            <?= $form->field($model, 'req_attach') ?>

            <?= $form->field($model, 'accept_attach') ?>

            <?= $form->field($model, 'atetat_attach') ?>

            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
