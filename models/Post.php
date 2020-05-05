<?php


namespace app\models;


use yii\db\ActiveRecord;

class Post extends ActiveRecord
{
    public static function tableName()
    {
        return "posts";
    }

    public function fields()
    {
      return [
          "title"
      ];
    }

    public function rules()
    {
        return [
            [["title"],"required"]
        ];
    }

}