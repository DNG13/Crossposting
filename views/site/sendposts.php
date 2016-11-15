<?php 
    //use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
    
    $this->title = 'Відправлені пости';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>На цій сторінці відображаються всі пости, надіслані в соцмережі.</p>
    <a class="btn btn-info pull-right" href="<?= Yii::$app->urlManager->createUrl(['site/post']) ?>">Новий Пост</a> 
    <div class="site-index">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Соцмережа</th>
                    <th>Текст повідомлення</th>
                    <th>Час</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sendposts as $sendpost) { ?>
                    <tr class="odd">
                        <td>
                        <?php foreach ($sendposts_services as $sendposts_service) { ?>                    
                            <?php if ($sendposts_service->message_id == $sendpost->id) { ?>
                                <?=$sendposts_service->service?>
                                <br>
                            <?php } ?>
                        <?php } ?>
                        </td>
                        <td><?=$sendpost->message?></td>
                        <td><?=$sendpost->time?></td>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div>
        <ul class="nav nav-pills">           
            <li><a href="<?= Yii::$app->urlManager->createUrl(['site/servers']) ?>">Додати соц мережу</a></li>
            <li><a href="<?= Yii::$app->urlManager->createUrl(['site/post']) ?>">Написати новий пост</a></li>
        </ul>
    </div> 
</div>