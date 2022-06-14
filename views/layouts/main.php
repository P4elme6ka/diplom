<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => "Приемная комиссия",
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark',
        ],
    ]);

    $items = [
        ['label' => 'Домашняя', 'url' => ['/site/index']],
    ];

    if (Yii::$app->user->identity->role->name == "admin") {
        $items[] = ['label' => 'Управление приемом', 'url' => ['/acceptance/index']];
        $items[] = ['label' => 'Управление направлениями', 'url' => ['/acceptanceclass/index']];
        $items[] = ['label' => 'Управление аккаунтами', 'url' => ['/user/index']];
        $items[] = ['label' => 'Управление заявками', 'url' => ['/useracceptancerequest/index']];
    }

    if (Yii::$app->user->identity->role->name == 'user'){
        $items[] = ['label' => 'Управление заявками', 'url' => ['/useracceptancerequest/userindex']];
    }

    if (Yii::$app->user->isGuest) {
        $items[] = ['label' => 'Войти', 'url' => ['/site/login']];
        $items[] = ['label' => 'Зарегистрироваться', 'url' => ['/site/register']];
    } else {
        $items[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
            . Html::submitButton(
                'Выйти (' . Yii::$app->user->identity->email . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $items,
    ]);
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; Радиотехнический колледж<?= date('Y') ?></p>
<!--        <p class="float-right">--><?//= Yii::powered() ?><!--</p>-->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
