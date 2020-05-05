<?php


namespace app\controllers;


use app\DI\ITest;
use app\DI\Test;
use app\models\Post;
use app\Services\PostService;
use yii\rest\ActiveController;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ApiController extends ActiveController
{
    /**
     * @var PostService $postService
     */
    private $postService;

    public function __construct($id, $module, $config = [], PostService $postService)
    {
        parent::__construct($id, $module, $config);
        $this->postService = $postService;
    }

    public $modelClass = Post::class;

    public function actionTest()
    {

        $post = $this->postService->findById(1);
        return $post;
    }

    public function actionPush()
    {
        //ToDo push message to queue;

    }

    public function actionInsert()
    {
        $item = [
            "title" => "aaa",
            "content" => "demo content"
        ];
        $data = $this->postService->insert($item);
        if ($data !== true) {
            //insert failed
            throw new BadRequestHttpException(json_encode($data->getErrors()));
        }
        return  ["data"=>"OK"];
    }

    public function actionError()
    {
        throw new NotFoundHttpException("not found");
    }


    /** format json as response
     * @return array|array[]
     */
    public function behaviors()

    {

        $behaviors = parent::behaviors();


        $behaviors['contentNegotiator'] = [

            'class' => 'yii\filters\ContentNegotiator',

            'formats' => [

                'application/json' => Response::FORMAT_JSON,

            ]

        ];


        return $behaviors;

    }
}