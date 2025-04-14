<?php
namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class ShiftSwapRequests
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /** 
     * @ORM\ManyToOne(targetEntity="App\Entity\Workers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $originalWorker;

    /** 
     * @ORM\ManyToOne(targetEntity="App\Entity\Workers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $newWorker;

    /** 
     * @ORM\ManyToOne(targetEntity="App\Entity\Shifts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $shift;

    /** 
     * @ORM\ManyToOne(targetEntity="App\Entity\ShiftStatuses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOriginalWorker()
    {
        return $this->originalWorker;
    }

    public function setOriginalWorker($worker): self
    {
        $this->originalWorker = $worker;
        return $this;
    }

    public function getNewWorker()
    {
        return $this->newWorker;
    }

    public function setNewWorker($worker): self
    {
        $this->newWorker = $worker;
        return $this;
    }

    public function getShift()
    {
        return $this->shift;
    }

    public function setShift($shift): self
    {
        $this->shift = $shift;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status): self
    {
        $this->status = $status;
        return $this;
    }
}
