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
        foreach ($this->getStudentData() as [$firstName, $lastName]) {
            $student = new Student();
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
        foreach ($this->getSubjectData() as [$label, $domains]) {
            $subject = new Subject();
            $subject->setLabel($label);
            $subject->setDomains($domains);
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
            $manager->persist($mark);
        }
        
        $manager->flush();
    }
    
    private function getStudentData(): array
    {
        return [
            // $studentData = [$firstName, $lastName];
            ['John', 'Doe'],
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
              [$this->getReference('Domaine Management et Développement personnel')]
          ],
            [
                'Veille technologique et stratégique',
                [$this->getReference('Domaine Management et Développement personnel')]
            ],
            [
                'Droit',
                [$this->getReference('Domaine Management et Développement personnel')]
            ],
            [
                'Organisation des systèmes d\'information',
                [$this->getReference('Domaine Management et Développement personnel')]
            ],
            [
                'Mathématiques - statistique',
                [$this->getReference('Domaine Management et Développement personnel')]
            ],
            [
                'Gestion prévisionnelle',
                [$this->getReference('Domaine Management et Développement personnel')]
            ],
            [
                'Communication',
                [$this->getReference('Domaine Management et Développement personnel')]
            ],
            [
                'Anglais',
                [
                    $this->getReference('Domaine Management et Développement personnel'),
                    $this->getReference('Domaine International')
                ]
            ],
            [
                'Méthode UML',
                [$this->getReference('Domaine Informatique')]
            ],
            [
                'Informatique Décisionnelle',
                [$this->getReference('Domaine Informatique')]
            ],
            [
                'Développement JEE',
                [$this->getReference('Domaine Système d\'information')]
            ],
            [
                'Développement .Net',
                [$this->getReference('Domaine Système d\'information')]
            ],
            [
                'Développement Web + Application Mobile',
                [$this->getReference('Domaine Système d\'information')]
            ],
            [
                'Bases de données avancées',
                [$this->getReference('Domaine Système d\'information')]
            ],
            [
                'Projet dans la spécialité',
                [$this->getReference('Domaine Système d\'information')]
            ],
            [
                'Période en entreprise 1',
                [$this->getReference('Domaine Période 1')]
            ],
            [
                'Rapport 1',
                [$this->getReference('Domaine Période 1')]
            ],
            [
                'Soutenance 1',
                [$this->getReference('Domaine Période 1')]
            ],
            [
                'Management et Ingénierie de projet',
                [$this->getReference('Domaine Management')]
            ],
            [
                'Management des Hommes et efficacité personnelle',
                [$this->getReference('Domaine Management')]
            ],
            [
                'Conduite de réunion',
                [$this->getReference('Domaine Management')]
            ],
            [
                'Simulation Recrutement',
                [$this->getReference('Domaine Management')]
            ],
            [
                'Marketing',
                [$this->getReference('Domaine Management')]
            ],
            [
                'Ecoute client',
                [$this->getReference('Domaine Management')]
            ],
            [
                'Business Intelligence',
                [$this->getReference('Domaine Management')]
            ],
            [
                'Qualité Norme ISO',
                [$this->getReference('Domaine Qualité')]
            ],
            [
                'Qualité Livrable (CMMI)',
                [$this->getReference('Domaine Qualité')]
            ],
            [
                'ITIL V3',
                [$this->getReference('Domaine Qualité')]
            ],
            [
                'Organisation des DSI',
                [$this->getReference('Domaine Qualité')]
            ],
            [
                'Culture Internationale',
                [$this->getReference('Domaine International')]
            ],
            [
                'Mise en production et déploiement',
                [$this->getReference('Domaine Services')]
            ],
            [
                'La qualité des services',
                [$this->getReference('Domaine Services')]
            ],
            [
                'Support',
                [$this->getReference('Domaine Services')]
            ],
            [
                'Conférences Professionnelles',
                [$this->getReference('Domaine Conférences Professionnelles')]
            ],
            [
                'Période en entreprise 2',
                [$this->getReference('Domaine Fin de formation')]
            ],
            [
                'Synthèse Anglais',
                [$this->getReference('Domaine Fin de formation')]
            ],
            [
                'Rapport 2',
                [$this->getReference('Domaine Fin de formation')]
            ],
            [
                'Mémoire',
                [$this->getReference('Domaine Fin de formation')]
            ],
            [
                'Soutenance finale',
                [$this->getReference('Domaine Fin de formation')]
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
                11.5,
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
            ],
        ];
    }
}
