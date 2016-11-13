<?php
namespace app\models;

use yii\base\Model;

class PostForm extends  Model
{
    public $message;
    
    public function rules()
    {
        return [
            [['message'], 'required'],
            ['message', 'string', 'min' => 2, 'max' => 255],
            [['message'],'safe']
        ];
    }
}
