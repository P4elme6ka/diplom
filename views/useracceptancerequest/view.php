<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserAcceptanceRequest */
/* @var $attachment \yii\data\SqlDataProvider */

$this->title = $model->user->fio;
$this->params['breadcrumbs'][] = ['label' => 'Заявки абитуриентов на обучение', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-acceptance-request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (Yii::$app->user->identity->role->name == "admin") { ?>
            <?= Html::a('Принять оригиналы документов', ['setoriginal', 'id' => $model->id], [
                    'class' => 'btn btn-primary',
                ]) ?>
            <?= Html::a('Обновить заявку', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php } ?>
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

    <?= GridView::widget([
        'dataProvider' => $attachment,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Название файла',
                'attribute' => 'name',
            ],
            [
                'label' => 'Ссылка для скачивания',
                'attribute' => 'path',
                'format' => 'url',
                'value' => function($data) { return  Url::base(true) . '/' . $data['path']; },
            ],
        ]
    ]) ?>

</div>
