<?php


namespace app\controllers;


use app\DI\ITest;
use app\DI\Test;
use yii\web\Controller;

class TestController extends Controller
{
    private $test;
    public function __construct($id, $module, $config = [],ITest $test)
    {
        $this->test=$test;
//        var_dump($id); controller name
//        var_dump($module); controller module
//        var_dump($config);
        parent::__construct($id, $module, $config);
    }

    public function actionTest(){
//        /**
//         * @var Test $test
//         */
//        $test=\Yii::$container->get(ITest::class);
        var_dump($this->test->hello());
        var_dump("eeee");
        die();
    }

}