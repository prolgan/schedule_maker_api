<?php
namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;


use App\Model\User;

class UserController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function resolve($rootValue, array $args)
    {
        $userRepo = $this->entityManager->getRepository(User::class);

        if (!empty($args['id'])) {
            $user = $userRepo->find($args['id']);
            return [
                [
                    'id' => $user->getId(),
                    'userName' => $user->getUserName(),
                    'userSurname' => $user->getUserSurname(),
                    'email' => $user->getEmail(),
                ]
            ];
        }
        $users = $userRepo->findAll();
        return array_map(fn(User $user) => [
            'id' => $user->getId(),
            'userName' => $user->getUserName(),
            'userSurname' => $user->getUserSurname(),
            'email' => $user->getEmail(),
        ], $users);



    }



}