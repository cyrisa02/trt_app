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
use Symfony\Component\Form\Extension\Core\Type\FileType;

class CandidateSelfType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Nom ',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ],

            ])
            ->add('firstname',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Prénom',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ],

            ])
            //->add('cvName')
            // ->add('imageFile', VichImageType::class, [
            //     'label' => 'Merci de télécharger votre CV en pdf uniquement.',
            //     'label_attr' => [
            //         'class' => 'form-label mt-4'
            //     ],
            //     'required' => false
            // ])

             ->add('my_file', FileType::class, [
                 'mapped' => false,
                 'required' => false,
                 'label' => 'Télécharger votre CV en format pdf uniquement.',
                 'label_attr' => [
                     'class' => 'form-label  mt-4'
                 ],
             ])

            
            // ->add('isValided',CheckboxType::class, [
            //     'required' => false,
            //     'label' => 'Validation de ce profil'
            // ])
            
            // ->add('isRGPD',CheckboxType::class, [
            //     'mapped' => true,
            //     'label' => 'Je suis d\'accord avec le RGPD du site'
            // ])
             ->add('user',EntityType::class, [
                 'required' => false,
                 'class' => User::class,
                 'choice_label'=>function($email){
                 return $email->getEmail();
             },
                  'attr' => [
                      'class' => 'form-control '
                  ],
                 'label' => 'Merci de confirmer votre adresse mail. ',
                 'attr' => [
                     'class' => 'form-control '
                 ],
                 'placeholder'=>'Choisissez votre email dans la liste',

             ])

        //         ->add('user', EntityType::class,[
        //      'class' => User::class,
        //     'choice_label'=>function($email){
        //          return $email->getEmail();
        //     },
        //      'label' => 'Recherchez son adresse mail dans la liste.    .'
        //    ] )
            
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