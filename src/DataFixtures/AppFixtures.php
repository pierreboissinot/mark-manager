<?php

namespace App\DataFixtures;

use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $this->loadStudents($manager);
    }

    private function loadStudents(ObjectManager $manager)
    {
        foreach ($this->getStudentData() as [$firstName, $lastName]) {
            $student = new Student();
            $student->setFirstName($firstName);
            $student->setLastName($lastName);
            $manager->persist($student);
            $this->addReference($lastName, $student);
        }

        $manager->flush();
    }
    
    private function getStudentData(): array
    {
        return [
            // $studentData = [$firstName, $lastName];
            ['Pierre', 'Boissinot'],
        ];
    }
}
