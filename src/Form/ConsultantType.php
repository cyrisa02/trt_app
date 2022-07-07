<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Consultant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ConsultantType extends AbstractType
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
            ->add('tel',TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-4'
                ],
                'label' => 'Téléphone'

            ])
           ->add('user', EntityType::class,[
            'class' => User::class,
            'choice_label'=>function($email){
                return $email->getEmail();
            },
            'label' => 'Recherchez son adresse mail dans la liste.    .'
           ] )
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Consultant::class,
        ]);
    }
}