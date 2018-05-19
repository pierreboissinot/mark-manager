<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DomainRepository")
 */
class Domain
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
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $label;
    
    /**
     * @var PersistentCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Subject", mappedBy="domains")
     */
    private $subjects;

    public function __construct()
    {
        $this->subjects = new ArrayCollection();
    }
    
    public function getId(): int
    {
        return $this->id;
    }
    
    public function getLabel(): string
    {
        return $this->label;
    }
    
    public function setLabel(string $label): Domain
    {
        $this->label = $label;
        return $this;
    }
    
    public function getSubjects(): PersistentCollection
    {
        return $this->subjects;
    }
    
    public function setSubjects(ArrayCollection $subjects): Domain
    {
        $this->subjects = $subjects;
        return $this;
    }
    
    public function __toString(): string
    {
        return $this->getLabel();
    }
    
    
}