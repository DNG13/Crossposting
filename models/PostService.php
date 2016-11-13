<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Vk_data;
use Abraham\TwitterOAuth\TwitterOAuth;
class PostService extends  Model
{
    public function vkPost(){
        $url = "https://api.vk.com/method/wall.post";
        $access_token  = Vk_data::find('access_token')->where(['user_id' => Yii::$app->user->getId()])->one()->access_token;
        $owner_id = Vk_data::find('vk_id ')->where(['user_id' => Yii::$app->user->getId()])->one()->vk_id ;
        $message = Yii::$app->request->post("PostForm")['message'];
        //could be my site link
        $link = "";
        $Request = $url."?owner_id=".$owner_id."&access_token=".$access_token."&message=".$message."&attachment=".$link;
        // VK request
        $sRequest=file_get_contents($Request);
        return  $sRequest;
    }
     public function twPost(){
        // Twitter Connection Info
        $twitter_consumer_key = 'd9rvycRV0KUXA4KG0kZdvtpMH';
        $twitter_consumer_secret = 'f276vhVWLWkmXuUHuRfZAD976Ax82yN3Q86DRkIyOJWDfaUuws';              
        $twitter_access_token  = Tw_data::find('oauth_token')->where(['user_id' => Yii::$app->user->getId()])->one()->oauth_token;
        $twitter_access_token_secret = Tw_data::find('oauth_token_secret')->where(['user_id' => Yii::$app->user->getId()])->one()->oauth_token_secret;
        // Connect to Twitter
        $connection = new TwitterOAuth($twitter_consumer_key, $twitter_consumer_secret, $twitter_access_token, $twitter_access_token_secret);
        // Post Update
        $message = Yii::$app->request->post("PostForm")['message'];
        $sRequest1 = $connection->post('statuses/update', array('status' =>  $message));
        //$sRequest1=file_get_contents($Request1);
        return  $sRequest1;
     }
}