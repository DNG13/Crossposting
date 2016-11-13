<?php 
    //use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
    
    $this->title = 'Головна';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="site-index">
        <img src="/project/web/images/octopus.png" alt="" />
        <h3>Pозумний кросспостинг</h3>
        <p>Надсилайте повідомлення одним кліком в свої блоги та соціальні мережі.</p>
        <p>Трохи більше інформації про кросспостинг і про сайт N.Cross-posting можно дізнатись на сторінці <a href="<?= Yii::$app->urlManager->createUrl(['site/about']) ?>">Про нас</a>.</p>
        <p>Про вирішення питаня по роботі на сайту читайте <a href="<?= Yii::$app->urlManager->createUrl(['site/help']) ?>">тут</a>.</p>
        <p>Більш детально про конфіденційність на сайте можно дізнатись на <a href="<?= Yii::$app->urlManager->createUrl(['site/privacy']) ?>">цієй</a> сторінці.</p>
    </div>
</div>
