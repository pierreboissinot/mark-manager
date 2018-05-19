<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Mark", mappedBy="subject")
     */
    private $marks;
    
    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Domain", inversedBy="subjects")
     * @ORM\JoinTable(name="subjects_domains")
     */
    private $domains;
    
    public function __construct()
    {
        $this->marks = new ArrayCollection();
        $this->domains = new ArrayCollection();
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
    
    public function getMarks(): ArrayCollection
    {
        return $this->marks;
    }
    
    public function setMarks(array $marks): Subject
    {
        $this->marks = $marks;
        return $this;
    }
    
    public function getDomains(): ArrayCollection
    {
        return $this->domains;
    }
    
    public function setDomains(array $domains): Subject
    {
        $this->domains = $domains;
        return $this;
    }
    
    
}