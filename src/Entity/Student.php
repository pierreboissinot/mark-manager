<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
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

    /** @var \ArrayAccess */
    //private $marks;
    
}
