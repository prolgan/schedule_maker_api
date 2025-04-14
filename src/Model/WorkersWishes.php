<?php
namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class WorkersWishes
{
    /** 
     * @ORM\Id 
     * @ORM\GeneratedValue 
     * @ORM\Column(type="integer")
     */
    private $id;

    /** 
     * @ORM\ManyToOne(targetEntity="App\Entity\DaysInSchedule")
     * @ORM\JoinColumn(nullable=false)
     */
    private $day;

    /** @ORM\Column(type="datetime") */
    private $shiftStart;

    /** @ORM\Column(type="datetime") */
    private $shiftEnd;

    /** @ORM\Column(type="float") */
    private $maxHours;

    /** @ORM\Column(type="boolean") */
    private $available;

    /** 
     * @ORM\ManyToOne(targetEntity="App\Entity\Workers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $worker;

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

    public function getMaxHours(): ?float
    {
        return $this->maxHours;
    }

    public function setMaxHours(float $maxHours): self
    {
        $this->maxHours = $maxHours;
        return $this;
    }

    public function isAvailable(): ?bool
    {
        return $this->available;
    }

    public function setAvailable(bool $available): self
    {
        $this->available = $available;
        return $this;
    }

    public function getWorker()
    {
        return $this->worker;
    }

    public function setWorker($worker): self
    {
        $this->worker = $worker;
        return $this;
    }

}
