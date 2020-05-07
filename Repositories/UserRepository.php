<?php


namespace app\Repositories;


use app\models\User;
use app\Repositories\Interfaces\IUserRepository;

class UserRepository extends BaseRepository implements IUserRepository
{

    protected function getModel()
    {
       return User::class;
    }

    public function getUserByEmail($email)
    {
        return $this->query->where(["email"=>$email])->one();
    }
}