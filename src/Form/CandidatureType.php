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

class CandidatureType extends AbstractType
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
            ->add('isValided',CheckboxType::class, [
                //'mapped' => true,
                'required' => false,
                'label' => 'En tant que consultant vous pouvez valider cette candidature.'
            ])

            ->add('user',EntityType::class, [
                'class' => User::class,
                'choice_label'=>function($email){
                return $email->getEmail();
            },
            'label' => 'Merci de confirmer votre adresse mail. ',
                'attr' => [
                    'class' => 'form-control '
                ],
                'placeholder'=>'Choisissez votre email dans la liste',

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