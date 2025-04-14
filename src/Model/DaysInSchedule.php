<?php
namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "daysInSchedule")]
class DaysInSchedule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;


    #[ORM\ManyToOne(targetEntity: Schedule::class)]
    #[ORM\JoinColumn(name: "schedule", referencedColumnName: "id",nullable: false)]
    private $schedule;

    #[ORM\Column(type: "datetime")]
    private $day;

    #[ORM\Column(type: "integer")]
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getSchedule()
    {
        return $this->schedule;
    }
    
    public function setSchedule($schedule): self
    {
        $this->schedule = $schedule;
        return $this;
    }
    
    public function getDay(): ?\DateTimeInterface
    {
        return $this->day;
    }
    
    public function setDay(\DateTimeInterface $day): self
    {
        $this->day = $day;
        return $this;
    }
    
    public function getStatus(): ?int
    {
        return $this->status;
    }
    
    public function setStatus(int $status): self
    {
        $this->status = $status;
        return $this;
    }
    
}
