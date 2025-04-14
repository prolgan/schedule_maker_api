<?php
namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;

use App\Model\Team;
use App\Model\User;

class TeamController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

 
    public function resolve($rootValue, array $args)
    {
        $teamRepo = $this->entityManager->getRepository(Team::class);

        $criteria = [];
        
        if (!empty($args['id'])) {
            $criteria['id'] = $args['id'];
        }
    
        if (!empty($args['managerId'])) {
            $criteria['manager'] = $args['managerId'];
        }
    
        $teams = $teamRepo->findBy($criteria);

        return array_map(function($team) {
            return [
                'id' => $team->getId(),
                'teamName' => $team->getTeamName(),
                'manager' => $team->getManager() ? [
                    'id' => $team->getManager()->getId(),
                    'userName' => $team->getManager()->getUserName(),
                    'userSurname' => $team->getManager()->getUserSurname(),
                    'email' => $team->getManager()->getEmail(),
                ] : null,
            ];
        }, $teams);

    }

    public function createTeam($rootValue, array $args)
    {

        $userRepo = $this->entityManager->getRepository(User::class);
        $manager = $userRepo->find($args['managerId']);

        if (!$manager) {
            throw new \Exception("Manager not found");
        }

        $team = new Team();
        $team->setTeamName($args['teamName']);
        $team->setManager($manager);

        $this->entityManager->persist($team);
        $this->entityManager->flush();

        return [
            'id' => $team->getId(),
            'teamName' => $team->getTeamName()
        ];

    }
}