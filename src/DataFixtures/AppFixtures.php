<?php

namespace App\DataFixtures;

use App\Entity\Domain;
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
    
    private function getStudentData(): array
    {
        return [
            // $studentData = [$firstName, $lastName];
            ['Pierre', 'Boissinot'],
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
}
