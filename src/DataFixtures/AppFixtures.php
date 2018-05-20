<?php

namespace App\DataFixtures;

use App\Entity\Domain;
use App\Entity\Mark;
use App\Entity\Student;
use App\Entity\Subject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $this->loadStudents($manager);
        $this->loadDomains($manager);
        $this->loadSubjects($manager);
        $this->loadMarks($manager);
    }

    private function loadStudents(ObjectManager $manager)
    {
        foreach ($this->getStudentData() as [$email, $firstName, $lastName]) {
            $student = new Student();
            $student->setEmail($email);
            $student->setFirstName($firstName);
            $student->setLastName($lastName);
            $manager->persist($student);
            $this->addReference($lastName, $student);
        }

        $manager->flush();
    }
    
    private function loadDomains(ObjectManager $manager)
    {
        foreach ($this->getDomainData() as [$label]){
            $domain = new Domain();
            $domain->setLabel($label);
            $manager->persist($domain);
            $this->addReference($label, $domain);
        }
        
        $manager->flush();
    }
    
    private function loadSubjects(ObjectManager $manager)
    {
        foreach ($this->getSubjectData() as [$label, $coefficient, $domain]) {
            $subject = new Subject();
            $subject->setLabel($label);
            $subject->setDomain($domain);
            $subject->setCoefficient($coefficient);
            $manager->persist($subject);
            $this->addReference($label, $subject);
        }
        
        $manager->flush();
    }
    
    private function loadMarks(ObjectManager $manager)
    {
        foreach ($this->getMarkData() as [$value, $student, $subject]) {
            $mark = new Mark();
            $mark->setValue($value);
            $mark->setStudent($student);
            $mark->setSubject($subject);
            $mark->setInAcademicTranscript(true);
            $manager->persist($mark);
        }
        
        $manager->flush();
    }
    
    private function getStudentData(): array
    {
        return [
            // $studentData = [$email, $firstName, $lastName];
            ['pierre.boissinot2015@campus-eni.fr','John', 'Doe']
        ];
    }
    
    private function getDomainData()
    {
        return [
          ['Domaine Management et Développement personnel'],
            ['Domaine Informatique'],
            ['Domaine Système d\'information'],
            ['Domaine Période 1'],
            ['Domaine Management'],
            ['Domaine Qualité'],
            ['Domaine International'],
            ['Domaine Services'],
            ['Domaine Conférences Professionnelles'],
            ['Domaine Fin de formation']
        ];
    }
    
    private function getSubjectData()
    {
        return [
          [
              'Conduite de projet - Méthode Agile',
              3,
              $this->getReference('Domaine Management et Développement personnel')
          ],
            [
                'Veille technologique et stratégique',
                2,
                $this->getReference('Domaine Management et Développement personnel')
            ],
            [
                'Droit',
                2,
                $this->getReference('Domaine Management et Développement personnel')
            ],
            [
                'Organisation des systèmes d\'information',
                2,
                $this->getReference('Domaine Management et Développement personnel')
            ],
            [
                'Mathématiques - statistique',
                2,
                $this->getReference('Domaine Management et Développement personnel')
            ],
            [
                'Gestion prévisionnelle',
                2,
                $this->getReference('Domaine Management et Développement personnel')
            ],
            [
                'Communication',
                2,
                $this->getReference('Domaine Management et Développement personnel')
            ],
            [
                'Anglais',
                5,
                $this->getReference('Domaine Management et Développement personnel')
            ],
            [
                'Méthode UML',
                3,
                $this->getReference('Domaine Informatique')
            ],
            [
                'Informatique Décisionnelle',
                2,
                $this->getReference('Domaine Informatique')
            ],
            [
                'Développement JEE',
                6,
                $this->getReference('Domaine Système d\'information')
            ],
            [
                'Développement .Net',
                6,
                $this->getReference('Domaine Système d\'information')
            ],
            [
                'Développement Web + Application Mobile',
                5,
                $this->getReference('Domaine Système d\'information')
            ],
            [
                'Bases de données avancées',
                5,
                $this->getReference('Domaine Système d\'information')
            ],
            [
                'Projet dans la spécialité',
                4,
                $this->getReference('Domaine Système d\'information')
            ],
            [
                'Période en entreprise 1',
                1,
                $this->getReference('Domaine Période 1')
            ],
            [
                'Rapport 1',
                2,
                $this->getReference('Domaine Période 1')
            ],
            [
                'Soutenance 1',
                1,
                $this->getReference('Domaine Période 1')
            ],
            [
                'Management et Ingénierie de projet',
                4,
                $this->getReference('Domaine Management')
            ],
            [
                'Management des Hommes et efficacité personnelle',
                1,
                $this->getReference('Domaine Management')
            ],
            [
                'Conduite de réunion',
                2,
                $this->getReference('Domaine Management')
            ],
            [
                'Simulation Recrutement',
                1,
                $this->getReference('Domaine Management')
            ],
            [
                'Marketing',
                1,
                $this->getReference('Domaine Management')
            ],
            [
                'Ecoute client',
                1,
                $this->getReference('Domaine Management')
            ],
            [
                'Business Intelligence',
                2,
                $this->getReference('Domaine Management')
            ],
            [
                'Qualité Norme ISO',
                1,
                $this->getReference('Domaine Qualité')
            ],
            [
                'Qualité Livrable (CMMI)',
                1,
                $this->getReference('Domaine Qualité')
            ],
            [
                'ITIL V3',
                2,
                $this->getReference('Domaine Qualité')
            ],
            [
                'Organisation des DSI',
                1,
                $this->getReference('Domaine Qualité')
            ],
            [
                'Culture Internationale',
                1,
                $this->getReference('Domaine International')
            ],
            [
                'Anglais 2',
                4,
                $this->getReference('Domaine International')
            ],
            [
                'Mise en production et déploiement',
                2,
                $this->getReference('Domaine Services')
            ],
            [
                'La qualité des services',
                2,
                $this->getReference('Domaine Services')
            ],
            [
                'Support',
                1,
                $this->getReference('Domaine Services')
            ],
            [
                'Conférences Professionnelles',
                1,
                $this->getReference('Domaine Conférences Professionnelles')
            ],
            [
                'Période en entreprise 2',
                1,
                $this->getReference('Domaine Fin de formation')
            ],
            [
                'Synthèse Anglais',
                1,
                $this->getReference('Domaine Fin de formation')
            ],
            [
                'Rapport 2',
                1,
                $this->getReference('Domaine Fin de formation')
            ],
            [
                'Mémoire',
                2,
                $this->getReference('Domaine Fin de formation')
            ],
            [
                'Soutenance finale',
                2,
                $this->getReference('Domaine Fin de formation')
            ]
        ];
    }
    
    private function getMarkData()
    {
        return [
            [
                11,
                $this->getReference('Doe'),
                $this->getReference('Conduite de projet - Méthode Agile')
            ],
            [
                11,
                $this->getReference('Doe'),
                $this->getReference('Veille technologique et stratégique')
            ],
            [
                12,
                $this->getReference('Doe'),
                $this->getReference('Droit')
            ],
            [
                11,
                $this->getReference('Doe'),
                $this->getReference('Organisation des systèmes d\'information')
            ],
            [
                10,
                $this->getReference('Doe'),
                $this->getReference('Mathématiques - statistique')
            ],
            [
                13.5,
                $this->getReference('Doe'),
                $this->getReference('Gestion prévisionnelle')
            ],
            [
                10,
                $this->getReference('Doe'),
                $this->getReference('Communication')
            ],
            [
                20,
                $this->getReference('Doe'),
                $this->getReference('Anglais')
            ],
            [
                13,
                $this->getReference('Doe'),
                $this->getReference('Méthode UML')
            ],
            [
                15,
                $this->getReference('Doe'),
                $this->getReference('Informatique Décisionnelle')
            ],
            [
                11,
                $this->getReference('Doe'),
                $this->getReference('Développement JEE')
            ],
            [
                10,
                $this->getReference('Doe'),
                $this->getReference('Développement .Net')
            ],
            [
                15,
                $this->getReference('Doe'),
                $this->getReference('Développement Web + Application Mobile')
            ],
            [
                6,
                $this->getReference('Doe'),
                $this->getReference('Bases de données avancées')
            ],
            [
                11.5,
                $this->getReference('Doe'),
                $this->getReference('Projet dans la spécialité')
            ],
            [
                18,
                $this->getReference('Doe'),
                $this->getReference('Période en entreprise 1')
            ],
            [
                10,
                $this->getReference('Doe'),
                $this->getReference('Rapport 1')
            ],
            [
                11,
                $this->getReference('Doe'),
                $this->getReference('Soutenance 1')
            ],
            [
                10,
                $this->getReference('Doe'),
                $this->getReference('Management et Ingénierie de projet')
            ],
            [
                11,
                $this->getReference('Doe'),
                $this->getReference('Management des Hommes et efficacité personnelle')
            ],
            [
                10,
                $this->getReference('Doe'),
                $this->getReference('Conduite de réunion')
            ],
            [
                13,
                $this->getReference('Doe'),
                $this->getReference('Simulation Recrutement')
            ],
            [
                11.5,
                $this->getReference('Doe'),
                $this->getReference('Marketing')
            ],
            [
                16.5,
                $this->getReference('Doe'),
                $this->getReference('Ecoute client')
            ],
            [
                15,
                $this->getReference('Doe'),
                $this->getReference('Business Intelligence')
            ],
            [
                12.5,
                $this->getReference('Doe'),
                $this->getReference('Qualité Norme ISO')
            ],
            [
                12,
                $this->getReference('Doe'),
                $this->getReference('Qualité Livrable (CMMI)')
            ],
            [
                13,
                $this->getReference('Doe'),
                $this->getReference('ITIL V3')
            ],
            [
                12,
                $this->getReference('Doe'),
                $this->getReference('Organisation des DSI')
            ],
            [
                11,
                $this->getReference('Doe'),
                $this->getReference('Culture Internationale')
            ],
            [
                11,
                $this->getReference('Doe'),
                $this->getReference('Mise en production et déploiement')
            ],
            [
                11,
                $this->getReference('Doe'),
                $this->getReference('La qualité des services')
            ],
            [
                11,
                $this->getReference('Doe'),
                $this->getReference('Support')
            ],
            [
                11,
                $this->getReference('Doe'),
                $this->getReference('Conférences Professionnelles')
            ],
            [
                15,
                $this->getReference('Doe'),
                $this->getReference('Période en entreprise 2')
            ],
            [
                20,
                $this->getReference('Doe'),
                $this->getReference('Synthèse Anglais')
            ],
            [
                11.5,
                $this->getReference('Doe'),
                $this->getReference('Rapport 2')
            ],
            [
                8,
                $this->getReference('Doe'),
                $this->getReference('Mémoire')
            ],
            [
                12,
                $this->getReference('Doe'),
                $this->getReference('Soutenance finale')
            ]
        ];
    }
}
