<?php

namespace App\Form;

use App\Entity\Job;
use App\Entity\User;
use App\Entity\Candidature;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class CandidatureApplyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('candidate')
            ->add('job',EntityType::class, [
                'class' => Job::class,
                'choice_label'=>function($title){
                return $title->getTitle();
            },
            'label' => 'Merci de choisir votre annonce ',
                'attr' => [
                    'class' => 'form-control '
                ],
                'placeholder'=>'Choisissez votre annonce dans la liste',

            ])
            

            // ->add('user',EntityType::class, [
            //     'class' => User::class,
            //     'choice_label'=>function($email){
            //     return $email->getEmail();
            // },
            // 'label' => 'Merci de confirmer votre adresse mail. ',
            //     'attr' => [
            //         'class' => 'form-control '
            //     ],
            //     'placeholder'=>'Choisissez votre email dans la liste',

            // ])
            ->add('isApplied',CheckboxType::class, [
                //'mapped' => true,
                'required' => false,
                'label' => 'Voulez-vous postuler à cette annonce.'
            ])
            ->add('isValid', CheckboxType::class, [
                'mapped' => false,
                'attr' => [
                    'class' => '',
                ],
                'required' => false,
                'label' => '      ',
                'label_attr' => [
                    'class' => 'form-check-label'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidature::class,
        ]);
    }
}