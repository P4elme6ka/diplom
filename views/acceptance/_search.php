<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AcceptanceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acceptance-search">

    <div id="accordion">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Поиск по году приема
                    </button>
                </h5>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <?php $form = ActiveForm::begin([
                        'action' => ['index'],
                        'method' => 'get',
                        'options' => [
                            'class' => 'form-inline'
                        ],
                    ]); ?>
                    <?= $form->field($model, 'year', [
                        'template' => '<div class="mx-sm-3 mb-2">{label}</div><div class="mx-sm-3 mb-2">{input}</div><div class="mx-sm-3 mb-2">{error}</div>{hint}',
                    ])->label("Год приема: ") ?>

                    <div class="form-group">
                        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary mx-sm-3 mb-2']) ?>
                        <?= Html::resetButton('Сбросить фильтры', ['class' => 'btn btn-outline-secondary mx-sm-3 mb-2']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

</div>
