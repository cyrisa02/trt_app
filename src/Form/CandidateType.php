<?php

namespace App\Form;

use App\Entity\Candidate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class CandidateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Nom '

            ])
            ->add('firstname',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Prénom'

            ])
            ->add('cvName')
           // ->add('isValided')
            
            ->add('isRGPD',CheckboxType::class, [
                'mapped' => true,
                'label' => 'Je suis d\'accord avec le RGPD du site'
            ])
            ->add('user',TextType::class, [
                'attr' => [
                    'class' => 'form-control '
                ],
                'label' => 'Merci de confirmer votre adresse mail. '

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidate::class,
        ]);
    }
}