<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */

/** @var app\models\RegistrationForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\jui\DatePicker;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                'id' => 'contact-form'
            ]); ?>

            <?= $form->field($model, 'fio') ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'birthDate')->widget(DatePicker::class, [
                'clientOptions' => [
                    'language' => 'ru',
                    'dateFormat' => 'yyyy-MM-dd',
                ]
            ]); ?>

            <?= $form->field($model, 'city') ?>

            <?= $form->field($model, 'age') ?>

            <?= $form->field($model, 'phone') ?>

            <?= $form->field($model, 'password') ?>

            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
