<?php
namespace app\Services;

use app\Repositories\Interfaces\IPostRepository;

class PostService
{
    protected $postRepository;
    public function __construct( IPostRepository $postRepository)
    {
        $this->postRepository=$postRepository;
    }

    public function findByTitle($title){
        return $this->postRepository->findByTitle($title);
    }

    public function findById($id){
        return $this->postRepository->find($id);
    }
    public function insert($data){
        return $this->postRepository->insert($data);
    }

}