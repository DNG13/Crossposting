<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>
    <p>
        The above error occurred while the Web server was processing your request.
        <br>Сталася помилка під час обробки веб-сервером вашого запиту.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
        <br>Будь ласка, зв'яжіться з нами, якщо ви думаєте, що це помилка сервера. Дякуємо.
    </p>
</div>
