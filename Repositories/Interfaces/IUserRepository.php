<?php


namespace app\Repositories\Interfaces;


interface IUserRepository extends IRepository
{
    public function getUserByEmail($email);
}