<?php
namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class WorkerRolePatterns
{
    /** 
     * @ORM\Id 
     * @ORM\GeneratedValue 
     * @ORM\Column(type="integer")
     */
    private $id;

    /** @ORM\Column(type="datetime") */
    private $shiftStart;

    /** @ORM\Column(type="datetime") */
    private $shiftEnd;

    /** 
     * @ORM\ManyToOne(targetEntity="App\Entity\WorkerRoles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $role;

    /** 
     * @ORM\ManyToOne(targetEntity="App\Entity\ManagerDaySettings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $managerDaySettings;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role): self
    {
        $this->role = $role;
        return $this;
    }

    public function getManagerDaySettings()
    {
        return $this->managerDaySettings;
    }

    public function setManagerDaySettings($settings): self
    {
        $this->managerDaySettings = $settings;
        return $this;
    }
}
