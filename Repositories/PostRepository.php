<?php
namespace app\Repositories;

use app\models\Post;
use app\Repositories\Interfaces\IPostRepository;

class PostRepository extends BaseRepository implements IPostRepository
{
    public function findByTitle($title)
    {
        return $this->query->where(["title"=>$title])->all();
    }

    public function getModel()
    {
        return Post::class;
    }
}