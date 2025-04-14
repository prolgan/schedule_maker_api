<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Model\Schedule;

class ScheduleController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function resolve($root, array $args)
    {
        try {
            $criteria = [];

            if (!empty($args['scheduleId'])) {
                $criteria['id'] = $args['scheduleId'];
            }

            if (!empty($args['teamId'])) {

                $criteria['team'] = $args['teamId'];
            }


            $schedules = $this->entityManager->getRepository(Schedule::class)->findBy($criteria);

            return array_map(function ($schedule) {
                return [
                    'id' => $schedule->getId(),
                    'scheduleName' => $schedule->getScheduleName(),
                    'dayStart' => $schedule->getDayStart()->format('Y-m-d H:i:s'),
                    'dayEnd' => $schedule->getDayEnd()->format('Y-m-d H:i:s'),
                    'team' => $schedule->getTeam() ? [
                        'id' => $schedule->getTeam()->getId(),
                        'teamName' => $schedule->getTeam()->getTeamName(),

                    ] : null,
                ];
            }, $schedules);
        } catch (\Throwable $e) {
            error_log("[GraphQL schedules] Kļūda: " . $e->getMessage());
            throw new \Exception("Servera kļūda: " . $e->getMessage());
        }
    }
}
