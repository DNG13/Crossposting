<?php 
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
    
    $this->title = 'Новий пост';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-post">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Нове повідомлення в соціальні мережі.</p>
    <i>Виберіть соцмережі до яких відсилати повідомлення.</i>
    <?php $form1 = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "\n<div class=\"col-lg-7\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ]])?> 
        <?= $form1->field($checkbox, 'services[]')->checkboxList($checkbox->servicesArray());?>
        <?= $form1->field($model, 'message')->textarea(['rows' => 7]) ?> 
        <div class="form-group">
            <div class="col-lg-offset-6 col-lg-11">
                <?= Html::submitButton('Відправити', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    <?php ActiveForm::end() ?>
</div>
    