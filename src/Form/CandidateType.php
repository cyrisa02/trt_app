<?php

namespace App\Form;

use App\Entity\User;
use App\Form\CvType;
use App\Entity\Candidate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('imageFile', VichImageType::class, [
                'label' => 'Merci de télécharger votre CV en pdf uniquement.',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'required' => false
            ])

            
           // ->add('isValided')
            
            ->add('isRGPD',CheckboxType::class, [
                'mapped' => true,
                'label' => 'Je suis d\'accord avec le RGPD du site'
            ])
            ->add('user',EntityType::class, [
                'class' => User::class,
                'choice_label'=>function($email){
                return $email->getEmail();
            },
                // 'attr' => [
                //     'class' => 'form-control '
                // ],
                'label' => 'Merci de confirmer votre adresse mail. '

            ])
            //->add('candidatures')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidate::class,
        ]);
    }
}