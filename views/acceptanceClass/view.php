<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AcceptanceClass */
/* @var $users \yii\data\SqlDataProvider */


$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Специальности'];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="acceptance-class-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->user->identity->role->name == "admin") {
        echo Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary mb-4']);
    } ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'class_id',
            'acceptance_id',
            'document_set_id',
            'name',
            'description:ntext',
        ],
    ]) ?>

    <?= GridView::widget([
        'dataProvider' => $users,
        'columns' => [
            'fio',
            'atestat_mean',
            'is_original'
        ],
    ]) ?>

</div>
