<?php

namespace App\Form;

use App\Entity\Job;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class JobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Titre de l\'annonce '

            ])
            ->add('workPlace',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Lieu '

            ])
            ->add('description',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Description du poste (Salaire, horaires, etc...)'

            ])
            ->add('isVisible',CheckboxType::class, [
                'mapped' => true,
                'label' => 'Voulez-vous rendre votre annonce visible?'
            ])
            ->add('recruiter')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Job::class,
        ]);
    }
}