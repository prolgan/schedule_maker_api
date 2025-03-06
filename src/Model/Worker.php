<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "workers")]
class Worker
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: "worker", referencedColumnName: "id")]
    private ?User $worker = null;

    #[ORM\ManyToOne(targetEntity: WorkerRole::class)]
    #[ORM\JoinColumn(name: "workerRole", referencedColumnName: "id")]
    private ?WorkerRole $workerRole = null;

    #[ORM\ManyToOne(targetEntity: Team::class)]
    #[ORM\JoinColumn(name: "team", referencedColumnName: "id")]
    private ?Team $team = null;

    public function getId(): int
    {
        return $this->id;
    }

    
}