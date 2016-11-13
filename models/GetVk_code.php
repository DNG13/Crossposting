<?php

namespace app\models;

use yii\base\Model;
class GetVk_code extends Model
{
    public $code;
    public function rules()
    {
        return [
            [['code'], 'required'],
            ['code', 'string', 'min' => 16, 'max' =>20],
            [['code'],'safe']
        ];
    }
}

