<?php

namespace app\models;

use yii\db\ActiveRecord;

class PostServices_data extends ActiveRecord {
    public static function tableName()
    {
        return 'service_message';
    }
}
