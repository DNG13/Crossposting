<?php

namespace app\models;

use yii\db\ActiveRecord;

class Vk_data extends ActiveRecord {
    public static function tableName()
    {
        return 'vk';
    }
}