<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Отримання коду Vk';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <p>Перейдіть за посиланням <a target="_blank" href="<?=$getvkcodelink?>">для отримання коду доступу VK</a></p>
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-5">
            <p>Зкопіюйте значення code з адресного рядка в поле нижче</p>
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <?= $form->field($vkcode, 'code')->textInput(['autofocus' => true]) ?>                   
                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>