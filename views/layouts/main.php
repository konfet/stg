<?php

/* @var $this \yii\web\View */
/* @var $content string */

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
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    
    $items = [
            1 => ['label' => 'Home', 'url' => ['/site/index']],
            2 => ['label' => 'About', 'url' => ['/site/about']],
            3 => ['label' => 'Contact', 'url' => ['/site/contact']],            
        ];
    
    
    if (Yii::$app->user->isGuest) {
        $items[4] = ['label' => 'Login', 'url' => ['/site/login']];
    }
    else {
        $items[4] = 
                ('<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>');
                
        $items[5] = ['label' => 'YOUR ACCOUNT',
                'items' => [
                ['label' => 'Personal data', 'url' => ['data/settings']],
                ['label' => 'Prizes', 'url' => ['data/prizes']],    
                ['label' => 'Statistics', 'url' => ['data/statistics']],
                //['label' => Yii::$app->params['languages']['en-US'], 'url' => ['site/set-language', 'language' => 'en-US']],
            ]];

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
        <p class="float-left">&copy; Slotegrator <?= date('Y') ?></p>
<!--        <p class="float-right"><?= Yii::powered() ?></p>-->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
