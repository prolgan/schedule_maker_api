<?php
namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;


use App\Model\User;

class UserController extends ObjectType{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;

        parent::__construct([
            'name' => 'User',
            'fields' => [
                'id' => ['type' => Type::int()],
                'userName' => ['type' => Type::string()],
                'userSurname' => ['type' => Type::string()],
                'email' => ['type' => Type::string()],
                'password' => ['type' => Type::string()],                
            ],
        ]);
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

        
    }
}