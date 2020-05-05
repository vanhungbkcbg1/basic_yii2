<?php


namespace app\controllers;


use app\Repositories\Interfaces\IPostRepository;
use app\Services\PostService;
use yii\web\Controller;

class PostController extends Controller
{
    private $postService;
    public function __construct($id, $module, $config = [],PostService $postService)
    {
        parent::__construct($id, $module, $config);
        $this->postService=$postService;
    }

    public function actionTest(){
//        $data =$this->repository->find("1");
//        var_dump($data);
//
//        // demo insert
//        $item=[
//          "title"=>"demo insert",
//          "content"=>"demo content"
//        ];
//        $this->repository->insert($item);

        //using service
        $item=[
          "title"=>"",
          "content"=>"demo content"
        ];
        $data= $this->postService->insert($item);


//        $data=$this->postService->findById('1');
//        var_dump($data);
//        die();
    }

}