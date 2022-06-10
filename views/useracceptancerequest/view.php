<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserAcceptanceRequest */

$this->title = $model->user->fio;
$this->params['breadcrumbs'][] = ['label' => 'Заявки абитуриентов на обучение', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-acceptance-request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Принять оригиналы документов', ['setoriginal', 'id' => $model->id], [
                'class' => 'btn btn-primary',
            ]) ?>
        <?= Html::a('Обновить заявку', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить завявку', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить заявку?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'date',
            'is_original',
            'user_id',
            'atestat_mean',
            'acceptance_class_id',
        ],
    ]) ?>

</div>
