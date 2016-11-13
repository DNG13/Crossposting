<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Fb_data;
use app\models\Tw_data;
use app\models\Vk_data;
use app\models\PostService;
use app\models\PostServices_data;

class PostCheckbox extends Model{
    
    public $services=[   
        ];
    
    public function servicesArray(){
        $url ='<img src="/project/web/images/icons/';
        $services=[];
        $vktoken = Vk_data::find()->where(['user_id' => Yii::$app->user->getId()])->one();
        $twtoken = Tw_data::find()->where(['user_id' => Yii::$app->user->getId()])->one();
        $fbtoken = Fb_data::find()->where(['user_id' => Yii::$app->user->getId()])->one();
        if($vktoken!==null){
            $services['vk'] = $url.'vkontakte.png"/> VK';
        }   
        if($twtoken!==null){
            $services['tw'] = $url.'twitter.png"/> Twitter';
        } 
        if($fbtoken!==null){
            $services['fb'] = $url.'facebook.png"/> Facebook';
        }
        $services['ok'] =$url.'ok.png"/> OK';
        $services['in'] =$url.'instagram.png"/> Instagram';        
            return  $services;       
    }
    
    public function rules()
    {
        return[
            ['services', 'required'],
        ];         
    }
    
    public function Checkbox($id){ 
        $webservices =  Yii::$app->request->post('PostCheckbox')['services'];
        $N = count($webservices);
        $model = new PostService();
        $sRequest ='';
        $sRequest1 ='';
        $postservices=[];
        for($i=0; $i < $N; $i++)
        {
            if($webservices[$i]=='vk')
            {
               $sRequest = $model->vkPost();
               $postservices[] = $sRequest;
               $model2 = new PostServices_data();
               $model2->service = 'VK' ;
               $model2->message_id =  $id;
               $model2->save();
            }
            if($webservices[$i]=='tw')
            {
                $sRequest1 = $model->twPost();
                $postservices[] = $sRequest1;
                $model2 = new PostServices_data();
                $model2->service = 'Twitter' ;
                $model2->message_id =  $id;
                $model2->save();
            }
        }
        return $postservices; 
    } 
}

