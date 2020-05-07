<?php
namespace app\Filters;

use Yii;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;

class DemoFilter extends \yii\base\ActionFilter
{

    public function beforeAction($action)
    {
        return false;
    }
}