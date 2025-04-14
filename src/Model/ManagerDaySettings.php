<?php
namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "managerDaySettings")]
class ManagerDaySettings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\ManyToOne(targetEntity: DaysInSchedule::class)]
    #[ORM\JoinColumn(name: "day", referencedColumnName: "id", nullable: false)]
    private $day;

    #[ORM\Column(type: "float")]
    private $maxHours;

    #[ORM\Column(type: "float")]
    private $shiftMinTime;

    #[ORM\Column(type: "float")]
    private $shiftMaxTime;

    #[ORM\Column(type: "float")]
    private $shiftTimeStep;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay()
    {
        return $this->day;
    }

    public function setDay($day): self
    {
        $this->day = $day;
        return $this;
    }

    public function getMaxHours(): ?float
    {
        return $this->maxHours;
    }

    public function setMaxHours(float $maxHours): self
    {
        $this->maxHours = $maxHours;
        return $this;
    }

    public function getShiftMinTime(): ?float
    {
        return $this->shiftMinTime;
    }

    public function setShiftMinTime(float $value): self
    {
        $this->shiftMinTime = $value;
        return $this;
    }

    public function getShiftMaxTime(): ?float
    {
        return $this->shiftMaxTime;
    }

    public function setShiftMaxTime(float $value): self
    {
        $this->shiftMaxTime = $value;
        return $this;
    }

    public function getShiftTimeStep(): ?float
    {
        return $this->shiftTimeStep;
    }

    public function setShiftTimeStep(float $value): self
    {
        $this->shiftTimeStep = $value;
        return $this;
    }
}
