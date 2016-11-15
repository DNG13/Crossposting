
<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Успішна реєстрація';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
<p>Вітаємо. Ви успішно зареєструвались на сайті.
    <br>
    Для подальшої роботи на сайті перейдіть за
    <a href="<?= Yii::$app->urlManager->createUrl(['site/login']) ?>">цим </a> посиланням і залогіньтесь.   
</p>
</div>