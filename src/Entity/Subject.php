<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubjectRepository")
 */
class Subject
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
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $coefficient;
    
    /**
     * @var PersistentCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Mark", mappedBy="subject")
     */
    private $marks;
    
    /**
     * @var Domain
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Domain", inversedBy="subjects")
     */
    private $domain;
    
    public function __construct()
    {
        $this->marks = new ArrayCollection();
        $this->domain = new ArrayCollection();
    }
    
    public function getId(): int
    {
        return $this->id;
    }
    
    public function getLabel(): string
    {
        return $this->label;
    }
    
    public function setLabel(string $label): Subject
    {
        $this->label = $label;
        return $this;
    }
    
    public function getMarks(): PersistentCollection
    {
        return $this->marks;
    }
    
    public function setMarks(array $marks): Subject
    {
        $this->marks = $marks;
        return $this;
    }
    
    public function getDomain(): ?Domain
    {
        return $this->domain;
    }
    
    public function setDomain(Domain $domain): Subject
    {
        $this->domain = $domain;
        return $this;
    }
    
    public function __toString(): string
    {
        return "{$this->getLabel()}";
    }
    
    public function getCoefficient(): ?int
    {
        return $this->coefficient;
    }
    

    public function setCoefficient(int $coefficient): void
    {
        $this->coefficient = $coefficient;
    }
    
    
}
