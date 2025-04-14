<?php
namespace App\Controller;
use App\Model\WorkerRole;
use Doctrine\ORM\EntityManagerInterface;


class WorkerRoleController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function resolve($rootValue, array $args)
    {
        $repo = $this->entityManager->getRepository(WorkerRole::class);

        $queryBuilder = $repo->createQueryBuilder('wr')
            ->leftJoin('wr.team', 't')
            ->where('t.id = :teamId OR t.id IS NULL')
            ->setParameter('teamId', $args['teamId']);

        $workerRoles = $queryBuilder->getQuery()->getResult();

        return array_map(function ($workerRole) {
            return [
                'id' => $workerRole->getId(),
                'roleName' => $workerRole->getRoleName(),
            ];
        }, $workerRoles);

    }

    public function create(array $args)
    {
        $team = $this->entityManager->getRepository(\App\Model\Team::class)->find($args['teamId']);

        if (!$team) {
            throw new \Exception("Komanda netika atrasta");
        }

        $role = new WorkerRole();
        $role->setTeam($team);
        $role->setRoleName($args['roleName']);

        $this->entityManager->persist($role);
        $this->entityManager->flush();

        return [
            'id' => $role->getId(),
            'roleName' => $role->getRoleName(),
        ];
    }

}