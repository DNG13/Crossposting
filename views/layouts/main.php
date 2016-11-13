<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
    <script src="//yastatic.net/share2/share.js"></script>
    <meta charset = "utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/project/web/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <link rel="shortcut icon" href="/project/web/favicon.ico" type="image/x-icon">
    <script type="text/javascript" src="/project/web/assets/6e258e9e/jquery.min.js"></script>
    <link href="/project/web/assets/f743218b/css/bootstrap.min.css" rel="stylesheet" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div id="header">
   
</div>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'N.Cross-posting',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Головна', 'url' => ['/site/index']],
            ['label' => 'Про нас', 'url' => ['/site/about']],
            ['label' => 'Соцмережі', 'url' => ['/site/services']],
            ['label' => 'Відправлені пости', 'url' => ['/site/sendposts']],
            ['label' => 'Новий пост', 'url' => ['/site/post']],
            ['label' => 'Допомога', 'url' => ['/site/help']],        
            Yii::$app->user->isGuest ? (
                    ['label' => 'Реєстрація', 'url' => ['/site/signup']]
            ) : (""),
            Yii::$app->user->isGuest ? (
                ['label' => 'Увійти', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Вийти (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            ),
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>
<br><div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,gplus,twitter, instagram"></div>
<footer class="footer">
    <ul class="list-inline">
        <li><a href="<?= Yii::$app->urlManager->createUrl(['site/about']) ?>">Про нас</a></li>
        <li><a href="<?= Yii::$app->urlManager->createUrl(['site/help']) ?>">Допомога</a></li>
        <li><a href="<?= Yii::$app->urlManager->createUrl(['site/privacy']) ?>">Конфіденційність</a></li>       
    </ul> 
    <div class="container">
        <p class="pull-left">&copy; N.Cross-posting  <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
