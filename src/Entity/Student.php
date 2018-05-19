<?php

namespace App\Entity;

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
    
}
