<?php
namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Shifts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\ManyToOne(targetEntity: DaysInSchedule::class)]
    #[ORM\JoinColumn(name: "day", referencedColumnName: "id", nullable: false)]
    private $day;
    
    #[ORM\Column(type: "datetime")]
    private \DateTimeInterface $shiftStart;

    #[ORM\Column(type: "datetime")]
    private \DateTimeInterface $shiftEnd;


    #[ORM\ManyToOne(targetEntity: WorkerRole::class)]
    #[ORM\JoinColumn(name: "role", referencedColumnName: "id")]
    private ?WorkerRole $role = null;

    #[ORM\ManyToOne(targetEntity: Worker::class)]
    #[ORM\JoinColumn(name: "worker", referencedColumnName: "id")]
    private ?Worker $worker = null;

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

    public function getShiftStart(): ?\DateTimeInterface
    {
        return $this->shiftStart;
    }

    public function setShiftStart(\DateTimeInterface $shiftStart): self
    {
        $this->shiftStart = $shiftStart;
        return $this;
    }

    public function getShiftEnd(): ?\DateTimeInterface
    {
        return $this->shiftEnd;
    }

    public function setShiftEnd(\DateTimeInterface $shiftEnd): self
    {
        $this->shiftEnd = $shiftEnd;
        return $this;
    }

    public function getRole(): WorkerRole|null
    {
        return $this->role;
    }

    public function setRole($role): self
    {
        $this->role = $role;
        return $this;
    }

    public function getWorker(): Worker|null
    {
        return $this->worker;
    }

    public function setWorker($worker): self
    {
        $this->worker = $worker;
        return $this;
    }
}