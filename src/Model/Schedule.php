<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "schedules")]
class Schedule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Team::class)]
    #[ORM\JoinColumn(name: "team", referencedColumnName: "id", nullable: false)]
    private Team $team;

    #[ORM\Column(type: "string", length: 255)]
    private string $scheduleName;

    #[ORM\Column(type: "datetime")]
    private \DateTimeInterface $dayStart;

    #[ORM\Column(type: "datetime")]
    private \DateTimeInterface $dayEnd;

    // Getteri un setteri

    public function getId(): int
    {
        return $this->id;
    }

    public function getTeam(): Team
    {
        return $this->team;
    }

    public function setTeam(Team $team): self
    {
        $this->team = $team;
        return $this;
    }

    public function getScheduleName(): string
    {
        return $this->scheduleName;
    }

    public function setScheduleName(string $scheduleName): self
    {
        $this->scheduleName = $scheduleName;
        return $this;
    }

    public function getDayStart(): \DateTimeInterface
    {
        return $this->dayStart;
    }

    public function setDayStart(\DateTimeInterface $dayStart): self
    {
        $this->dayStart = $dayStart;
        return $this;
    }

    public function getDayEnd(): \DateTimeInterface
    {
        return $this->dayEnd;
    }

    public function setDayEnd(\DateTimeInterface $dayEnd): self
    {
        $this->dayEnd = $dayEnd;
        return $this;
    }
}
