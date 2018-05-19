<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Summons
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
    private $sentAt;
    
    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $content;
    
    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Retake", mappedBy="summons")
     */
    private $retakes;
    
    /**
     * @var Student
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Student", inversedBy="summons")
     */
    private $student;
    
    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getSentAt(): ?\DateTime
    {
        return $this->sentAt;
    }
    
    public function setSentAt(\DateTime $sentAt): Summons
    {
        $this->sentAt = $sentAt;
        return $this;
    }
    
    public function getContent(): ?string
    {
        return $this->content;
    }
    
    public function setContent(string $content): Summons
    {
        $this->content = $content;
        return $this;
    }
    
    public function getRetakes()
    {
        return $this->retakes;
    }
    
    public function setRetakes(array $retakes): ?Summons
    {
        $this->retakes = $retakes;
        return $this;
    }
    
    public function getStudent(): ?Student
    {
        return $this->student;
    }
    
    public function setStudent(Student $student): ?Summons
    {
        $this->student = $student;
        return $this;
    }
    
}