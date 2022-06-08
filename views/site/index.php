<?php

/* @var yii\web\View $this
 * @var \yii\data\SqlDataProvider $current_acceptance_provider
 */


use yii\helpers\Url;

$this->title = 'Приемная комиссия';
?>
<div class="site-index">
    <div class="body-content">

        <h1>Список актуальных специальностей: </h1><br>

        <?php
        if (count($current_acceptance_provider->getModels()) != 0){
            foreach ($current_acceptance_provider->getModels() as $acceptance_group) { ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= $acceptance_group['name'] ?></h5>
                        <p class="card-text"><?= $acceptance_group['description'] ?></p>
                        <a href="<?= Url::to(['acceptanceclass/view', 'id' => $acceptance_group['id']]) ?>" class="card-link">Посмотреть рейтинги</a>
                        <a href="<?= Url::to(['createacc']) ?>" class="card-link">Подать заявление</a>
                        <p class="card-text"><small class="text-muted">Последние обновление <?= $acceptance_group["time"] ?></small></p>
                    </div>
                </div>
            <? }
        }?>

    </div>
</div>
