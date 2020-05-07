<?php
return [
    \app\DI\ITest::class => \app\DI\Test::class,
    \app\Repositories\Interfaces\IPostRepository::class=>\app\Repositories\PostRepository::class,
    \app\Repositories\Interfaces\IUserRepository::class=>\app\Repositories\UserRepository::class
];