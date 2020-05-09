<?php

namespace app\modules\v1\controllers;

use app\modules\v1\models\Post;

class PostController extends \yii\rest\ActiveController
{
    public $modelClass = Post::class;

    public function actionTest()
    {
        return "hello module";
    }
}