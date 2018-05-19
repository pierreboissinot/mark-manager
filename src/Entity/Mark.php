<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MarkRepository")
 */
class Mark
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
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $value;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $label;
    
    /**
     * @var Student
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Student", inversedBy="marks")
     */
    private $student;
    
    /**
     * @var Subject
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Subject", inversedBy="marks")
     */
    private $subject;
    
    public function getId(): int
    {
        return $this->id;
    }
    
    public function getValue(): float
    {
        return $this->value;
    }
    
    public function setValue(float $value): Mark
    {
        $this->value = $value;
        return $this;
    }
    
    public function getLabel(): string
    {
        return $this->label;
    }
    
    public function setLabel(string $label): Mark
    {
        $this->label = $label;
        return $this;
    }
    
    public function getStudent(): Student
    {
        return $this->student;
    }
    
    public function setStudent(Student $student): Mark
    {
        $this->student = $student;
        return $this;
    }
    
    public function getSubject(): Subject
    {
        return $this->subject;
    }
    
    public function setSubject(Subject $subject): Mark
    {
        $this->subject = $subject;
        return $this;
    }

    
    
}
