<?php

namespace app\models;

use Yii;
use yii\base\Model;
use Abraham\TwitterOAuth\TwitterOAuth;
//use Facebook;

class Services_link extends Model{
    
    public function getVkCodeLink() {
        $url = "http://oauth.vk.com/authorize";
        $client_id = "5700556"; // Application ID
        $scope = "offline,wall";
        $redirect_uri = "https://oauth.vk.com/blank.htm"; // Site address      
        $links = $url."?client_id=".$client_id."&scope=".$scope."&redirect_uri=".$redirect_uri."&response_type=code";
        return $links;
    }
    
    public function twitterLink() {  
        $session = Yii::$app->session;
        $consumer_key = "d9rvycRV0KUXA4KG0kZdvtpMH";
        $consumer_secret = "f276vhVWLWkmXuUHuRfZAD976Ax82yN3Q86DRkIyOJWDfaUuws";
        $url_callback = 'http://127.0.0.1/project/web/site/twitter_callback'; 
        // create TwitterOAuth object
        $twitteroauth = new TwitterOAuth($consumer_key, $consumer_secret); 
        // request token of application
        $request_token = $twitteroauth->oauth(
            'oauth/request_token', ['oauth_callback' => $url_callback]
        ); 
        // throw exception if something gone wrong
        if($twitteroauth->getLastHttpCode() != 200) {
            throw new \Exception('There was a problem performing this request');
        }
        // save token of application to session
        $session->set('oauth_token', $request_token['oauth_token']);
        $session->set('oauth_token_secret', $request_token['oauth_token_secret']);
        // generate the URL to make request to authorize our application
        $links = $twitteroauth->url(
            'oauth/authorize', ['oauth_token' => $request_token['oauth_token']]
        );
        return $links;
    }
    
    public function fbLink() { 
        $redirect_uri = "http://127.0.0.1/project/web/site/fb_callback";
        $client_id = '834207340054626';
        //$app_secret = 'bab196daa02db4f50baf15ae6479915f';
        $url = 'https://www.facebook.com/dialog/oauth';
        $scope = 'user_posts';
        $links = $url."?client_id=".$client_id."&scope=".$scope."&redirect_uri=".$redirect_uri."&response_type=code";
        return $links;
        /*$callback = "http://127.0.0.1/project/web/site/fb_callback";
        $app_id = '834207340054626';
        $app_secret = 'bab196daa02db4f50baf15ae6479915f';
        $fb = new Facebook\Facebook([
            'app_id' => $app_id,
            'app_secret' => $app_secret,
            'default_graph_version' => 'v2.8',
        ]);
        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['user_posts']; // optional
        $links = $helper->getLoginUrl($callback, $permissions);
        return $links;    
        /*
        $session = Yii::$app->session;
        try {
            if ($session->has(['facebook_access_token'])) {
                $accessToken = $session['facebook_access_token'];
            } else {
                $accessToken = $helper->getAccessToken();
            }
        } catch(Facebook\Exceptions\facebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        } if (isset($accessToken)) {
            if ($session->has(['facebook_access_token'])) {
            $fb->setDefaultAccessToken($session['facebook_access_token']);
            } else {
                // getting short-lived access token
                $session['facebook_access_token'] = (string) $accessToken;
                // OAuth 2.0 client handler
                $oAuth2Client = $fb->getOAuth2Client();
                // Exchanges a short-lived access token for a long-lived one
                $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($session['facebook_access_token']);
                $session['facebook_access_token'] = (string) $longLivedAccessToken;
                // setting default access token to be used in script
                $fb->setDefaultAccessToken($session['facebook_access_token']);
            }
        }   */  
    }
}
    