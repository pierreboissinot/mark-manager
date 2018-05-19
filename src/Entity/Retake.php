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
    private $mark;
    
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
    
    public function getMark(): ?Mark
    {
        return $this->mark;
    }
    
    public function setMark(Mark $mark): ?Retake
    {
        $this->mark = $mark;
        return $this;
    }
    
    
}