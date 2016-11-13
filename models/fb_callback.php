<?php
namespace app\models;

use Yii;
use yii\base\Model;
use Facebook;
use app\models\Fb_data;

class fb_callback extends Model{
    public function getFbToken(){
        $request = Yii::$app->request;
        $result = '';
        if ( $request->get('code')) {
            $result = false;
            $redirect_uri = "http://127.0.0.1/project/web/site/fb_callback";
            $client_id = '834207340054626';
            $client_secret = 'bab196daa02db4f50baf15ae6479915f';
            $code = $request->get('code');
            $params = array(
                'client_id'     => $client_id,
                'redirect_uri'  => $redirect_uri,
                'client_secret' => $client_secret,
                'code'          =>  $code
            );
            $url = 'https://graph.facebook.com/oauth/access_token';
            $tokenInfo = null;
            parse_str(file_get_contents($url . '?' . http_build_query($params)), $tokenInfo);
            if (count($tokenInfo) > 0 && isset($tokenInfo['access_token'])) {
                $params = array('access_token' => $tokenInfo['access_token']);
                $userInfo = json_decode(file_get_contents('https://graph.facebook.com/me' . '?' . urldecode(http_build_query($params))), true);
                if (isset($userInfo['id'])) {
                    $userInfo = $userInfo;
                    $result = true;
                }
                echo $userInfo;
                $model = new Fb_data();
                $model ->fb_access_token= $tokenInfo['access_token'];
                $model ->user_id = Yii::$app->user->getId();
                $model->save();
            }
        }
        /*$app_id = '834207340054626';
        $app_secret = 'bab196daa02db4f50baf15ae6479915f';
        $fb = new Facebook\Facebook([
            'app_id' => $app_id,
            'app_secret' => $app_secret,
            'default_graph_version' => 'v2.8',
        ]);
        $helper = $fb->getRedirectLoginHelper();
        try {
          $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
          // When Graph returns an error
          echo 'Graph returned an error: ' . $e->getMessage();
          exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
          // When validation fails or other local issues
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
          exit;
        }
        if (! isset($accessToken)) {
          if ($helper->getError()) {
            header('HTTP/1.0 401 Unauthorized');
            echo "Error: " . $helper->getError() . "\n";
            echo "Error Code: " . $helper->getErrorCode() . "\n";
            echo "Error Reason: " . $helper->getErrorReason() . "\n";
            echo "Error Description: " . $helper->getErrorDescription() . "\n";
          } else {
            header('HTTP/1.0 400 Bad Request');
            echo 'Bad request';
          }
          exit;
        }
        // Logged in
        echo '<h3>Access Token</h3>';
        var_dump($accessToken->getValue());
        // The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();
        // Get the access token metadata from /debug_token
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);
        echo '<h3>Metadata</h3>';
        var_dump($tokenMetadata);
        // Validation (these will throw FacebookSDKException's when they fail)
        $tokenMetadata->validateAppId($app_id); 
        // If you know the user ID this access token belongs to, you can validate it here
        //$tokenMetadata->validateUserId('123');
        $tokenMetadata->validateExpiration();
        if (! $accessToken->isLongLived()) {
          // Exchanges a short-lived access token for a long-lived one
          try {
            $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
          } catch (Facebook\Exceptions\FacebookSDKException $e) {
            echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
            exit;
          }
          echo '<h3>Long-lived</h3>';
          var_dump($accessToken->getValue());
        }
        $session = Yii::$app->session;
        $session['fb_access_token'] = (string) $accessToken;
        $model = new Fb_data();
        $model ->fb_access_token= $session['fb_access_token'];
        $model ->user_id = Yii::$app->user->getId();
        $model->save();
        // User is logged in with a long-lived access token.
        // You can redirect them to a members-only page.
        //header('Location: https://example.com/members.php');
        /*$session = Yii::$app->session;
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
        // and redirect
        $model = new Fb_data();
        $model ->oauth_token = $token['oauth_token'];
        $model ->oauth_token_secret = $token['oauth_token_secret'];
        $model ->user_id = Yii::$app->user->getId();
        $model->save();*/
    }
}

