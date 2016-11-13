<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Vk_data;

class Access_token extends Model{
    public  $access_token;
    public function getVkToken() {
        $model = new Vk_data;
        $url = "https://oauth.vk.com/access_token";
        $client_id = "5700556"; // Application ID
        $client_secret = "7pGm2F9PTIiD44SIlJ6L"; // Secure key
        $redirect_uri = "https://oauth.vk.com/blank.htm";
        $code = Yii::$app->request->post("GetVk_code")['code'];
        $vktoken_link = $url."?client_id=".$client_id."&client_secret=".$client_secret."&code=".$code."&redirect_uri=".$redirect_uri;
        $output = file_get_contents($vktoken_link);
        $token = json_decode($output, true);
        $access_token = $token["access_token"];
        $vk_id = $token["user_id"];
        $model ->access_token = $access_token;
        $model ->vk_id = $vk_id;
        $model ->user_id = Yii::$app->user->getId();
        $model->save();
        return $vktoken_link;
    }
}