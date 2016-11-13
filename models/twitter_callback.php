<?php
namespace app\models;

use Yii;
use yii\base\Model;
use Abraham\TwitterOAuth\TwitterOAuth;
use app\models\Tw_data;

class twitter_callback extends Model{
    public function getTwToken(){
        $session = Yii::$app->session;
        $consumer_key = "d9rvycRV0KUXA4KG0kZdvtpMH";
        $consumer_secret = "f276vhVWLWkmXuUHuRfZAD976Ax82yN3Q86DRkIyOJWDfaUuws";
        $oauth_verifier = filter_input(INPUT_GET, 'oauth_verifier');
        // connect with application token
        if (empty($oauth_verifier) || empty($session['oauth_token']) ||empty($session['oauth_token_secret'])) {
            throw new \Exception('There was a problem performing this request1'); }
        $connection = new TwitterOAuth(
            $consumer_key,
            $consumer_secret,
            $session['oauth_token'],
            $session['oauth_token_secret']
        );
        // request user token
        $token = $connection->oauth('oauth/access_token', ['oauth_verifier' => $oauth_verifier]);
        $model = new Tw_data();
        $model ->oauth_token = $token['oauth_token'];
        $model ->oauth_token_secret = $token['oauth_token_secret'];
        $model ->user_id = Yii::$app->user->getId();
        $model->save();
    }
}

