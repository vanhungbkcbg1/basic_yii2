<?php
namespace app\Repositories\Interfaces;

interface IPostRepository extends IRepository
{
    public function findByTitle($title);
}