<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Про нас';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <img src="/project/web/images/sross.png" alt="" />
    <p>
       Основну інформацію про кросспостинг ви можете знайти на <a target="_blank" href="https://en.wikipedia.org/wiki/Crossposting"> вікіпедії</a>.
        <br>N.Cross-posting - це сервіс з кросспостингу в різноманітні соціальні мережі.
        <br>Ви можете написати повідомлення і відправити його одразу в усі свої блоги одним кліком. 
        <br>Це дає можливість економити час і працювати з єдиного інтерфейсу. 
        <br>Для цього лише необхідно бути зареєстрованим в соцмережах.
    </p>
</div>
