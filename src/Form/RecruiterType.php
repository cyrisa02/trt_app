<?php

namespace App\Form;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Recruiter;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
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
            //->add('isValided')
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
                'label' => 'Merci de confirmer votre adresse mail. ',
                

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recruiter::class,
        ]);
    }
}