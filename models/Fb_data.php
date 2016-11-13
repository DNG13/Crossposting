<?php

namespace app\models;

use yii\db\ActiveRecord;

class Fb_data extends ActiveRecord {
    public static function tableName()
    {
        return 'fb';
    }
}
