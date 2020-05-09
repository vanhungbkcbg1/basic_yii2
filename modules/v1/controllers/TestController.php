<?php


namespace app\modules\v1\controllers;


use yii\web\Controller;

class TestController extends Controller
{
    public $layout="base";
    public function actionIndex(){
        return $this->render("index",["abc"=>1]);
    }
}