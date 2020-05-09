<?php
namespace app\modules\v1\models;

class Post extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return "posts";
    }
}