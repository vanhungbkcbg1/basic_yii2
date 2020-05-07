<?php


namespace app\Services;


use app\Repositories\Interfaces\IUserRepository;

class UserService
{
    /**
     * @var IUserRepository $userRepository
     */
    private $userRepository;
    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository=$userRepository;
    }

    public function insert($data){
        return $this->userRepository->insert($data);
    }

    public function findByEmail($email){
        return $this->userRepository->getUserByEmail($email);
    }
    public function find($id){
        return $this->userRepository->find($id);
    }
}