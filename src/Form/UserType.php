<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('email')
            //->add('roles')
            //->add('password')
            //->add('created_at')
            //->add('candidate')
            //->add('recruiter')
            ->add('lastname', TextType::class, [
                'mapped' => true, 
                           'label' => 'Nom de famille',
                                                  
                          
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ],  
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],      

             ])
             ->add('firstname', TextType::class, [
                'mapped' => true, 
                           'label' => 'Prénom',
                                                  
                          
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ],  
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '190',
                ],      

             ])
             
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}