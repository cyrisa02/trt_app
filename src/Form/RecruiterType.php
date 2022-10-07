<?php

namespace App\Form;
use App\Entity\User;
use App\Entity\Recruiter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class RecruiterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('lastname',TextType::class, [
            //     'mapped' => false, 
            //     'attr' => [
            //         'class' => 'form-control'
            //     ],
            //     'label' => 'Nom '

            // ])
            // ->add('firstname',TextType::class, [
            //     'mapped' => false, 
            //     'attr' => [
            //         'class' => 'form-control'
            //     ],
            //     'label' => 'Prénom'

            // ])
             ->add('firmName',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Nom de votre société'

            ])
            ->add('addressFirm',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Adresse de la société'

            ])
           
            ->add('zipcode',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Code postal'

            ])
            ->add('city',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Ville'

            ])
            ->add('isValided',CheckboxType::class, [
                'required' => false,
                'label' => 'Validation de ce profil',
                'attr' => [
                    'class' => 'form-check-input ms-4 mt-4',
                ],
              'label_attr' => [
                    'class' => 'form-check-label mt-4'
                ]
                
            ])
            
            // ->add('email',TextType::class, [
            //     'attr' => [
            //         'class' => 'form-control'
            //     ],
            //     'label' => 'Veuillez saisir l\' adresse mail'

            // ])
            // ->add('user',EntityType::class, [
            //     'class'=>User::class,
            //     'choice_label'=>function($email){
            //     return $email->getEmail();
            //     },
            //     'placeholder'=>'Reconfirmer l\'email par rapport à la liste',
            //     'attr' => [
            //         'class' => 'form-control '
            //     ],
            //     'label' => 'Merci de confirmer l\' adresse mail. ',
                

            // ])

            // ->add('isRGPD',CheckboxType::class, [
            //     'mapped' => true,
            //     'label' => 'Je suis d\'accord avec le RGPD du site'
            // ])
            // ->add('roles', EntityType::class, [
            //     'class'=>User::class,
            //     'choice_label'=>function($roles){
            //     return $roles->getRoles();
            //     },
            //     'placeholder'=>'Choisissez votre email dans la liste',
            //     'attr' => [
            //         'class' => 'form-control '
            //     ],
            //     'label' => 'Merci de confirmer l\' adresse mail. ',
                

            // ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recruiter::class,
        ]);
    }
}