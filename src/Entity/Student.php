<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StudentRepository")
 */
class Student
{
    
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $lastName;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $firstName;
    
    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Mark", mappedBy="student")
     */
    private $marks;
    
    public function __construct()
    {
        $this->marks = new ArrayCollection();
    }
    
    public function getLastName(): ?string
    {
        return $this->lastName;
    }
    
    public function setLastName(string $lastName): Student
    {
        $this->lastName = $lastName;
        return $this;
    }
    
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }
    
    public function setFirstName(string $firstName): Student
    {
        $this->firstName = $firstName;
        return $this;
    }
    
    public function getMarks(): ArrayCollection
    {
        return $this->marks;
    }
    
    public function setMarks(ArrayCollection $marks): Student
    {
        $this->marks = $marks;
        return $this;
    }
    
}
