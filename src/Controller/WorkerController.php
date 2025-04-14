<?php
namespace App\Controller;

use App\Model\Worker;
use App\Model\Team;
use App\Model\Schedule;
use Doctrine\ORM\EntityManagerInterface;


class WorkerController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function resolve($root, $args)
    {

        $criteria = [];

        if (!empty($args['scheduleId'])) {
            
            $schedule = $this->entityManager->getRepository(Schedule::class)->find($args['scheduleId']);
            if (!$schedule) {
                throw new \Exception("Grafiks netika atrasts.");
            }
            $team = $schedule->getTeam();
            if (!$team) {
                throw new \Exception("Grafika komandai nav piesaistīta.");
            }

            $criteria['team'] = $team;
        }


        if (!empty($args['teamId'])) {
            $team = $this->entityManager->getRepository(Team::class)->find($args['teamId']);
            if (!$team) {
                throw new \Exception("Komanda netika atrasta.");
            }
            $criteria['team'] = $team;
        }
        
        

        $workers = $this->entityManager->getRepository(Worker::class)->findBy($criteria);

        return array_map(function ($worker) {
            return [
                'id' => $worker->getId(),
                'worker' => $worker->getWorker() ? [
                    'id' => $worker->getWorker()->getId(),
                    'userName' => $worker->getWorker()->getUserName(),
                    'userSurname' => $worker->getWorker()->getUserSurname(),
                    'email' => $worker->getWorker()->getEmail(),
                ] : null,
                'team' => $worker->getTeam() ? [
                    'id' => $worker->getTeam()->getId(),
                    'teamName' => $worker->getTeam()->getTeamName(),
                ] : null,
                'role' => $worker->getWorkerRole() ? [
                    'id' => $worker->getWorkerRole()->getId(),
                    'roleName' => $worker->getWorkerRole()->getRoleName(),

                ] : null,
            ];
        }, $workers);




    }

    public function addWorkerToTeam(array $args)
    {
        try {
            $team = $this->entityManager->getRepository(Team::class)->find($args['teamId']);
            if (!$team) {
                throw new \Exception("Komanda netika atrasta");
            }

            $role = $this->entityManager->getRepository(\App\Model\WorkerRole::class)->find($args['roleId']);
            if (!$role) {
                throw new \Exception("Loma netika atrasta");
            }

            $user = $this->entityManager->getRepository(\App\Model\User::class)->findOneBy(['email' => $args['email']]);
            if (!$user) {
                throw new \Exception("Lietotajs netika atrasts");
            }

            $worker = new Worker();
            $worker->setWorker($user);
            $worker->setTeam($team);
            $worker->setWorkerRole($role);


            $this->entityManager->persist($worker);
            $this->entityManager->flush();

            return [
                'id' => $worker->getId(),
                'worker' => $worker->getWorker() ? [
                    'id' => $worker->getWorker()->getId(),
                    'userName' => $worker->getWorker()->getUserName(),
                    'userSurname' => $worker->getWorker()->getUserSurname(),
                    'email' => $worker->getWorker()->getEmail(),
                ] : null,
                'team' => $worker->getTeam() ? [
                    'id' => $worker->getTeam()->getId(),
                    'teamName' => $worker->getTeam()->getTeamName(),
                ] : null,
                'role' => $worker->getWorkerRole() ? [
                    'id' => $worker->getWorkerRole()->getId(),
                    'roleName' => $worker->getWorkerRole()->getRoleName(),

                ] : null,
            ];
        } catch (\Throwable $e) {
            error_log("[GraphQL addWorkerToTeam] Kļūda: " . $e->getMessage());
            throw new \Exception("Servera kļūda: " . $e->getMessage());
        }
    }
}
