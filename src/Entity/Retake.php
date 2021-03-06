<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Retake
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $deadline;
    
    /**
     * @var Mark
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Mark", inversedBy="retakes")
     */
    private $markToRetake;
    
    /**
     * @var Mark
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Mark")
     */
    private $mark;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Summons", inversedBy="retakes")
     */
    private $summons;
    
    public function __construct()
    {
        $this->deadline = new \DateTime();
    }
    
    
    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getDeadline(): ?\DateTime
    {
        return $this->deadline;
    }
    
    public function setDeadline(\DateTime $deadline): ?Retake
    {
        $this->deadline = $deadline;
        return $this;
    }
    
    public function getMarkToRetake(): ?Mark
    {
        return $this->markToRetake;
    }
    
    public function setMarkToRetake(Mark $markToRetake): ?Retake
    {
        $this->markToRetake = $markToRetake;
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getSummons()
    {
        return $this->summons;
    }
    
    /**
     * @param mixed $summons
     */
    public function setSummons($summons): void
    {
        $this->summons = $summons;
    }
    
    public function __toString()
    {
        return "Rattrapage de {$this->getMarkToRetake()->getSubject()} dû le {$this->getDeadline()->format('d/m/Y')}";
    }
    
    public function getMark(): ?Mark
    {
        return $this->mark;
    }
    
    public function setMark(Mark $mark): void
    {
        $this->mark = $mark;
    }
    
    
}