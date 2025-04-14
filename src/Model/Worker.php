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
    #[ORM\JoinColumn(name: "role", referencedColumnName: "id")]
    private ?WorkerRole $role = null;

    #[ORM\ManyToOne(targetEntity: Team::class)]
    #[ORM\JoinColumn(name: "team", referencedColumnName: "id")]
    private ?Team $team = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWorker(): User{
        return $this->worker;
    }

    public function getTeam(): Team{
        return $this->team;
    }

    public function getWorkerRole(): WorkerRole{
        return $this->role;
    }

    public function setWorker(User $user): self{
        $this->worker = $user;
        return $this;
    }

    public function setTeam(Team $team): self{
        $this->team = $team;
        return $this;
    }

    public function setWorkerRole(WorkerRole $workerRole ): self{
        $this->role = $workerRole;
        return $this;
    }



    
}