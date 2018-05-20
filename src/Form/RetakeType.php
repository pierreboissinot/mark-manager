<?php

namespace App\Form;

use App\Entity\Mark;
use App\Entity\Retake;
use App\Repository\DomainRepository;
use App\Repository\MarkRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RetakeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // By default, form fields include the 'required' attribute, which enables
        // the client-side form validation. This means that you can't test the
        // server-side validation errors from the browser. To temporarily disable
        // this validation, set the 'required' attribute to 'false':
        // $builder->add('content', null, ['required' => false]);
        
        $builder
            ->add('deadline')
        ;
        if (!empty($options['domainId'])) {
            $builder->add('mark', EntityType::class, [
                'class' => Mark::class,
                'query_builder' => function (MarkRepository $markRepository) use ($options) {
                    return $markRepository->createQueryBuilder('m')
                        ->join('m.subject', 's')
                        ->join('s.domain', 'd')
                        ->where('d.id=:domainId')
                        ->setParameter('domainId', $options['domainId'])
                        ;
                },
            ]);
        } else {
            $builder->add('mark');
        }
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Retake::class,
            'domainId' => null
        ]);
    }
}
