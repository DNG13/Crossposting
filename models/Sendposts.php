<?php

namespace app\models;

use yii\db\ActiveRecord;

class Sendposts extends ActiveRecord {
    public static function tableName()
    {
        return 'services';
    }
    
}
