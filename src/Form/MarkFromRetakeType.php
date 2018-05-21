<?php

namespace App\Form;

use App\Entity\Mark;
use App\Entity\Retake;
use App\Repository\DomainRepository;
use App\Repository\MarkRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Range;

class MarkFromRetakeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label')
            ->add('value', NumberType::class, [
                'constraints' => [
                    new Range([
                        'min' => 0,
                        'max' => 12,
                        'minMessage' => 'Le résultat doit être supérieur à 0.',
                        'maxMessage' => 'Une note de rattrapage ne peut être supérieure à 12'
                    ])
                ]
            ])
            ->add('date')
            ->add('subject')
            ->add('inAcademicTranscript')
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mark::class,
        ]);
    }
}
