<?php 
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
    
    $this->title = 'Реєстрація';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <h3>Crossposting - це можливість розміщення того ж повідомлення<br>
    до декількох інформаційних каналів,<br>
    такич як соціальні мережі.<br></h3>
    <p>Будь ласка, заповніть наступні поля для реєстрації.</p>
     <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
        <?= $form->field($model, 'username')->textInput(['autofocus'=>true]) ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'email')->textInput(['autofocus'=>true]) ?>
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Зареєструватись', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>
    <?php ActiveForm::end() ?>
    <p>Або 
        <a href="<?= Yii::$app->urlManager->createUrl(['site/login'])?>" >увійдіть</a> .
    </p>
</div>