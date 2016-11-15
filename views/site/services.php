<?php 
    //use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
    
    $this->title = 'Соцмережі';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-services">
    <h1><?= Html::encode($this->title) ?></h1>
    <h4>Додайте ваші блоги і акаунти в соціальних мережах тут.</h4>
    <div class="well" style="padding-bottom: 3px;">
        <div class="services">
            <ul class="auth-services clear">
                <li class="Vkontakte">
                    <?php if ($vktoken == null): ?>
                        <br><a href="<?= Yii::$app->urlManager->createUrl(['site/getvkcode']) ?>">                        
                        <img src="/project/web/images/icons/vkontakte.png" alt="vkontakte"/>VK</a>
                    <?php else: ?>                    
                        Додано<img src="/project/web/images/icons/vkontakte.png" alt="vkontakte" />VK
                    <?php endif; ?>
                </li>
                <li class="Twitter">
                    <?php if ($twtoken == null): ?>
                        <br><a href="<?= Yii::$app->urlManager->createUrl(['site/twitter']) ?>">
                        <img src="/project/web/images/icons/twitter.png" alt="twitter"/>Twitter</a>
                    <?php else: ?>                    
                        Додано<img src="/project/web/images/icons/twitter.png" alt="twitter"/>Twitter
                    <?php endif; ?>               
                <li class="Facebook">
                    <?php if ($fbtoken == null): ?>
                        <br><a href="<?= 0//Yii::$app->urlManager->createUrl(['site/fb']) ?>">
                        <img src="/project/web/images/icons/facebook.png" alt="facebook"/>Facebook</a>
                    <?php else: ?>                    
                        Додано<img src="/project/web/images/icons/facebook.png" alt="facebook"/>Facebook
                    <?php endif; ?>                       
                </li>
                <li class="Odnoklassniki">
                    <br><a href="">
                    <img src="/project/web/images/icons/ok.png" alt="ok"/>OK</a>
                <li class="Instagram">
                    <br><a  href="">
                    <img src="/project/web/images/icons/instagram.png" alt="Instagram"/>Instagram</a>
                </li>
            </ul>
        </div>
    </div>
    <p>Щоб додати ваші блоги, натисніть на іконку вище. 
        <br>Після цього ви можете відправляти пости у додані мережі 
        <a href="<?= Yii::$app->urlManager->createUrl(['site/post']) ?>">тут.</a>
    </p>
</div>
                        