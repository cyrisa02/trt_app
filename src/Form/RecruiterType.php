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
                'label' => 'Validation de ce profil'
            ])
            ->add('isRGPD',CheckboxType::class, [
                'mapped' => true,
                'label' => 'Je suis d\'accord avec le RGPD du site'
            ])
            ->add('user',EntityType::class, [
                'class'=>User::class,
                'choice_label'=>function($email){
                return $email->getEmail();
                },
                'placeholder'=>'Choisissez votre email dans la liste',
                'attr' => [
                    'class' => 'form-control '
                ],
                'label' => 'Merci de confirmer l\' adresse mail. ',
                

            ])
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
//             ->add('roles', ChoiceType::class, array(
//     'attr'  =>  array('class' => User::class,
//                 'choice_label'=>function($roles){
//                 return $roles->getRoles();
//                 },
    
//     'form-control',
//     'style' => 'margin:5px 0;'),
//     'choices' => 
//     array
//     (
//         'ROLE_ADMIN' => array
//         (
//             'Yes' => 'ROLE_ADMIN',
//         ),
//         'ROLE_TEACHER' => array
//         (
//             'Yes' => 'ROLE_TEACHER'
//         ),
//         'ROLE_STUDENT' => array
//         (
//             'Yes' => 'ROLE_STUDENT'
//         ),
//         'ROLE_PARENT' => array
//         (
//             'Yes' => 'ROLE_PARENT'
//         ),
//     ) 
//     ,
//     'multiple' => true,
//     'required' => true,
//     )
// )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recruiter::class,
        ]);
    }
}