<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\ClassGroup */
/* @var $acceptance \yii\data\SqlDataProvider */
/* @var $students \yii\data\SqlDataProvider */


$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Список групп', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="class-group-view">

    <h1><?= Html::encode($this->title) ?></h1>
<!---->
<!--    <p>-->
<!--        --><?//= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
<!--        --><?//= Html::a('Delete', ['delete', 'id' => $model->id], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => 'Вы уверены что зотите удалить эту группу.',
//                'method' => 'post',
//            ],
//        ]) ?>
<!--    </p>-->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>


    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Прием <?= $acceptance->getModels()[0]["year"] ?></h5>
<!--            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
            <a href="<?= Url::toRoute(['acceptance/view', 'id' => $acceptance->getModels()[0]["id"]]) ?>" class="btn btn-primary">Перейти к приему</a>
        </div>
    </div>

    <div class="card card-body">
        <?php foreach ($students->getModels() as $student) { ?>
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title"><?= $student['fio'] ?></h5>
    <!--                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Телефон: <?= $student['phone'] ?> Город: <?= $student['phone'] ?> Почта: <?= $student['email'] ?></li>
                </ul>
                <div class="card-body">
                    <a href="<?= Url::toRoute(['user/view', 'id' => $student['id']]) ?>" class="card-link">Детальный вид пользователя</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
            </div>
        <?php } ?>
    </div>

</div>
